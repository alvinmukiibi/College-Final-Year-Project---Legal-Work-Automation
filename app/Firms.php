<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firms extends Model
{
    protected $fillable = [
        'name','description'
    ];


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
        //$this->uuid = uuid();
        
        if($this->save()){
            return $this->firm_id;
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
    
   
}
