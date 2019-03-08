<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\Exception\UnsatisfiedDependencyException;
use App\User;
use Illuminate\Support\Facades\DB;

class Firms extends Model
{
    protected $guarded = [];
    
    protected $fillable = [
        'name','description'
    ];

    public function user(){
        return $this->hasMany(User::class);
    }
    protected $table = "firms";


    protected function registerFirm($request){

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
        $this->password = bcrypt($this->firm_id);
        $this->uuid = Uuid::uuid1()->toString();
        
        if($this->save()){
            $data = ["otp"=> $this->firm_id, "uuid"=>$this->uuid];
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
    
   
}
