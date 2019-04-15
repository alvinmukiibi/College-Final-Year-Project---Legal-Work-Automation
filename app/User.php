<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Firm;
use App\Department;
use App\Todo;
use App\LegalCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";

    protected $fillable = [
         'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    public function firm(){
        return $this->belongsTo(Firm::class, 'firm_id', 'firm_id');
    }
    public function dept(){
        return $this->belongsTo(Department::class, 'department');
    }
    public function todos(){
        return $this->hasMany(Todo::class);
    }
    public function cases(){
        return $this->hasMany(LegalCase::class, 'staff');
    }
    
    public function activateUsers(){

        $activate = DB::table($this->table)->where(['firm_id'=> $this->firm_id])->update(["account_status"=>"active"]);

        if($activate){
            return true;
        }else{
            return false;
        }


    }
    public function deactivateUsers(){

        $deactivate = DB::table($this->table)->where(['firm_id'=> $this->firm_id])->update(["account_status"=>"inactive"]);

        if($deactivate){
        }else{
            return false;
        }


    }
    public function checkIfRequiresChangeOfPassword(){
        $user = $this->user;
        //get users otp
        $otpFromDB =  $this->getOtp($user->identification_token);

        if(Hash::check($otpFromDB, $user->password)){
            return true;
        }else{
            return false;
        }


    }
    public function getOtp($token){
        $otp = DB::table('otps')->where(['user_id'=>$token])->pluck('otp');
        foreach($otp as $value){
            return $value;
        }

    }
    public function changePassword(){

        $changedPassword = DB::table($this->table)->where(["id"=>$this->user_id])->update(["password"=>$this->newPassword]);
        if($changedPassword){
            return true;
        }
        else{
            return false;
        }
    }
    public function saveUserProfile(){
        $user = $this->userData;
        $image = $this->profilePicture;
        if(!$image){
            $save = DB::table($this->table)->where(['id'=> auth()->user()->id])->update(["fname"=> $user['firstName'], "lname"=>$user['lastName'], "contact"=>$user['contact'],"password"=>$this->password]);
        }else{
            $save = DB::table($this->table)->where(['id'=> auth()->user()->id])->update(["fname"=> $user['firstName'], "lname"=>$user['lastName'], "contact"=>$user['contact'], "profile_pic"=>$image, "password"=>$this->password]);

        }

        if($save){
            return true;
        }else{
            return false;
        }
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
    public function addStaff(){
        $staff = $this->data;
        $add = DB::table($this->table)->insert(['fname'=> $staff['firstName']  , 'lname'=> $staff['lastName'], 'email'=> $staff['email'] , 'contact'=> $staff['phone'], 'gender'=>$staff['gender'], 'department'=>$staff['department'], 'user_role'=> $staff['role'], 'account_status'=> $this->account_status, 'verification_status'=>$this->verification_status, 'firm_id'=>$this->firm_id, 'password'=>Hash::make($this->password),'identification_token' => $this->id_token, 'profile_pic'=>$this->profile_pic]);

        if($add){
            return true;
        }else{
            return false;
        }


    }


    public function getAllStaffExceptMe()
    {

        $staff = DB::table($this->table)->join('departments', 'users.department','=', 'departments.id')->where('users.id','!=', auth()->user()->id)->where('users.firm_id', auth()->user()->firm_id)->select('users.*','departments.name','departments.description')->get();
        $count = $staff->count();
        if($count > 0){
           return $staff;
        }else{
            return [];
        }

    }
    public function activateStaff(){
        $activate = DB::table($this->table)->where(['id'=>$this->id])->update(['account_status'=>'active']);
        if($activate){
            return true;
        }else{
            return false;
        }
    }
    public function deactivateStaff(){
        $deactivate = DB::table($this->table)->where(['id'=>$this->id])->update(['account_status'=>'inactive']);
        if($deactivate){
            return true;
        }else{
            return false;
        }
    }
    public function verifyEmail(){

        $verified = DB::table($this->table)->where(['identification_token'=>$this->identifier])->update(["verification_status"=>'verified']);

        if($verified)
        {
            return true;
        }else{
            return false;
        }

    }
    public function persistOtp(){
        // $user = $this->data;

        $persisted = DB::table('otps')->insert(['user_id'=>$this->id_token, 'otp'=>$this->password, 'status'=>'valid']);
        if($persisted){
            return true;
        }else{
            return false;
        }
    }
    public function fetchAllStaff(){

    }

}
