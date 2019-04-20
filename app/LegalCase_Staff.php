<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class LegalCase_Staff extends Model
{
    protected $table = 'legal_case__staffs';

    public function ownCase(){
        return DB::table($this->table)->insert(['case_id' => $this->case_id, 'owner' => auth()->user()->id]);
    }
    public function assignCase(){
        return DB::table($this->table)->where('case_id', $this->case_id)->update(['assignee' => $this->assignee]);
    }
    public function referCase(){
        $getRow = DB::table($this->table)->where('case_id', $this->case_id)->get();
        foreach($getRow as $row){

            if($row->referee1 == null){
                return DB::table($this->table)->where('case_id', $this->case_id)->update(['referee1' => $this->referee]);
            }else if($row->referee2 == null){
                if($row->referee1 == $this->referee){
                    return 'same';

                }else{
                    return DB::table($this->table)->where('case_id', $this->case_id)->update(['referee2' => $this->referee]);


                }

            }else{
                return false;
            }

        }
    }
        public function getAllStaffonCase(){
            $arr = [];
            $users = DB::table($this->table)->where('case_id', $this->id)->select('owner','referee1','referee2','assignee')->get();
            foreach($users as $user){
                if($user->assignee != null){
                    $assignee = DB::table('users')->where('id', $user->assignee)->get();
                    $arr['assignee'] = $assignee;

                }else{
                    $owner = DB::table('users')->where('id', $user->owner)->get();
                    $arr['owner'] = $owner;
                }
                if($user->referee1 != null){
                    $referee1 = DB::table('users')->where('id', $user->referee1)->get();
                    $arr['referee1'] = $referee1;

                }
                if($user->referee2 != null){
                    $referee2 = DB::table('users')->where('id', $user->referee2)->get();
                    $arr['referee2'] = $referee2;

                }


            }
            return $arr;
        }


}
