<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Firms;
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
        return $this->belongsTo(Firms::class);
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
            return true;
        }else{
            return false;
        }

        
    }
    public function checkIfRequiresChangeOfPassword(){
        $user = $this->user;
        
        if(Hash::check($user->firm_id, $user->password)){
            return true;
        }else{
            return false;
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

        $add = DB::table($this->table)->insert(['fname'=> $staff['firstName']  , 'lname'=> $staff['lastName'], 'email'=> $staff['email'] , 'contact'=> $staff['phone'], 'gender'=>$staff['gender'], 'department'=>$staff['department'], 'user_role'=> $staff['role'], 'account_status'=> $this->account_status, 'verification_status'=>$this->verification_status, 'firm_id'=>$this->firm_id, 'password'=>Hash::make($this->password)]);

        if($add){
            return true;
        }else{
            return false;
        }

    }
    public function getAllStaffExceptMe()
    {
        $staff = DB::table($this->table)->where('id','!=', auth()->user()->id)->where('firm_id', auth()->user()->firm_id)->get();
        $count = $staff->count();
        if($count > 0){
            return $staff;
        }else{
            return [];
        }
        
    }
}