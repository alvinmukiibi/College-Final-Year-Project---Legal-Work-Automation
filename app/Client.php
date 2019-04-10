<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Client extends Model
{
    protected $table = 'clients';


    public function createNewClient(){
        $firm_id = $this->firm_id;
        $data = $this->data;

        $add = DB::table($this->table)->insert(['name' => $data['clientName'], 'nationality' => $data['nationality'], 'address' => $data['address'], 'district_of_residence' => $data['district'], 'country' => $data['country'], 'city_of_residence' => $data['city'], 'mobile_contact' => $data['mobile_no'], 'work_contact' =>$data['work_no'] , 'home_contact' => $data['home_no'], 'email' => $data['email'], 'date_of_birth' => $data['dob'], 'marital_status' => $data['maritalStatus'], 'nin' => $data['nin'], 'firm_id' => $this->firm_id ]);

        if($add){

            return DB::getPdo()->lastInsertId();
        }
        else{
            return false;
        }



    }

}
