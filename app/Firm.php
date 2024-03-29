<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\User;
use App\Department;
use App\CaseType;
use App\Requisition;
use Illuminate\Support\Facades\DB;

class Firm extends Model
{
    protected $guarded = [];

    protected $table = "firms";

    protected $fillable = [
        'name','description'
    ];

    public function user(){
        return $this->hasMany(User::class, 'firm_id', 'firm_id');
    }
    public function departments(){
        return $this->hasMany(Department::class);
    }
    public function caseTypes(){
        return $this->hasMany(CaseType::class, 'firm_id', 'firm_id');
    }
    public function staffRequisitions(){
        return $this->hasMany(Requisition::class, 'firm_id');
    }

    public function getAllFirms(){

        return DB::table($this->table)->where(['activity_flag' => 'active', 'verification_flag' => 'verified'])->get();
    }


    protected function registerFirm($request){
        $otp = $this->generateOtp();
        $this->firm_id = $this->generateLawfirmUniqueNumber();
        $this->name = $request->input('name');
        $this->email = $request->input('email');
        $this->contact1 = $request->input('work_contact');
        $this->contact2 = $request->input('mobile_contact') ? $request->input('mobile_contact') : null;
        $this->country = $request->input('country');
        $this->area = $request->input('region');
        $this->city = $request->input('city');
        $this->street_address = $request->input('street_address');
        $this->website = $request->input('website') ? $request->input('website') : null;
        $this->description = $request->input('description') ? $request->input('description') : null;
        $this->activity_flag = "inactive";
        $this->verification_flag = "not_verified";
        $this->password = bcrypt($otp);
        $this->uuid = Uuid::uuid1()->toString();
        $this->slug = \str_replace(' ', '_', \strtolower($this->name));


        if($this->save()){
            $data = ["otp"=> $otp, "uuid"=>$this->uuid];
            return $data;
        }else{
            return false;
        }

    }
    protected function generateLawfirmUniqueNumber($length = 8){

        $characters = '0123456789ABCDEF';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return "WATL" ."_". $randomString;

    }
    public function generateOtp($length = 10){

        $characters = '0123456789ABCDEF';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }
    public function activate(){

        $activated = DB::table($this->table)->where('uuid', $this->uuid)->update(['activity_flag'=>'active']);
        if($activated){
            return true;
        }else{
            return false;
        }

    }
    public function deactivate(){

        $deactivated = DB::table($this->table)->where('uuid', $this->uuid)->update(['activity_flag'=>'inactive']);
        if($deactivated){
            return true;
        }else{
            return false;
        }

    }
    public function activateUsers(){

        $firm_id = DB::table($this->table)->where(["uuid" => $this->uuid])->pluck("firm_id");

        $user = new User;
        $user->firm_id = $firm_id;
        $activated = $user->activateUsers();

        if($activated){
            return true;
        }else{
            return false;
        }
    }
    public function deactivateUsers(){

        $firm_id = DB::table($this->table)->where(["uuid" => $this->uuid])->pluck("firm_id");

        $user = new User;
        $user->firm_id = $firm_id;
        $deactivated = $user->deactivateUsers();

        if($deactivated){
            return true;
        }else{
            return false;
        }
    }
    public function savelawfirmProfile(){
        $firm = $this->firmData;
        if($this->avatar==null){
        $add = DB::table($this->table)->where('firm_id', auth()->user()->firm_id)->update(['name'=> $firm['name']  , 'city'=> $firm['city'], 'country'=>$firm['country'], 'street_address'=>$firm['street_address'], 'website'=> $firm['website'], 'description'=> $firm['description'], 'contact1'=> $firm['contact1'], 'contact2'=> $firm['contact2'], 'area'=> $firm['area']]);
        return $add;
        }else{
            $add = DB::table($this->table)->where('firm_id', auth()->user()->firm_id)->update(['name'=> $firm['name']  , 'city'=> $firm['city'], 'country'=>$firm['country'], 'street_address'=>$firm['street_address'], 'website'=> $firm['website'], 'description'=> $firm['description'], 'contact1'=> $firm['contact1'], 'contact2'=> $firm['contact2'], 'avatar'=> $this->avatar, 'area'=> $firm['area']]);
            return $add;
        }
    }
    public function searchFirms(){
        $pattern = $this->pattern;
        return DB::table($this->table)->where('name', 'like', '%'.$pattern.'%')->where(['activity_flag' => 'active'])->get();
    }


}
