<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Lawyer_Case;
class LegalCase_Staff extends Model
{
    protected $table = 'legal_case__staffs';

    public function ownCase(){
        return DB::table($this->table)->insert(['case_id' => $this->case_id, 'owner' => auth()->user()->id]);
    }
    public function assignCase(){

        // once a case is assigned, its no longer open to the assigner but now open to the assignee
        // update value for assignee

        $ch = DB::table('lawyer__cases')->where('lawyer', $this->assignee)->count();
        if($ch == 0){
            $add =  DB::table('lawyer__cases')->insert(['lawyer' => $this->assignee, 'open_cases' => 1]);
        }else{
            $val = DB::table('lawyer__cases')->where('lawyer', $this->assignee)->value('open_cases');
            $newVal = $val + 1;
            $inc = DB::table('lawyer__cases')->where('lawyer', $this->assignee)->update(['open_cases' => $newVal]);
        }

        // update value for assigner

        $val1 = DB::table('lawyer__cases')->where('lawyer', auth()->user()->id)->value('open_cases');
        $newVal1 = $val1 - 1;
        $inc1 = DB::table('lawyer__cases')->where('lawyer', auth()->user()->id)->update(['open_cases' => $newVal1]);

        // record the assignment

        $assign = DB::table($this->table)->where('case_id', $this->case_id)->update(['assignee' => $this->assignee]);
        return $assign;
    }
    public function referCase(){
        $getRow = DB::table($this->table)->where('case_id', $this->case_id)->get();
        foreach($getRow as $row){

            if($row->referee1 == null){

            $ch = DB::table('lawyer__cases')->where('lawyer', $this->referee)->count();
            if($ch == 0){
                $add =  DB::table('lawyer__cases')->insert(['lawyer' => $this->referee, 'open_cases' => 1]);
            }else{
                $val = DB::table('lawyer__cases')->where('lawyer', $this->referee)->value('open_cases');
                $newVal = $val + 1;
                $inc = DB::table('lawyer__cases')->where('lawyer', $this->referee)->update(['open_cases' => $newVal]);
            }

                return DB::table($this->table)->where('case_id', $this->case_id)->update(['referee1' => $this->referee]);


            }else if($row->referee2 == null){
                if($row->referee1 == $this->referee){
                    return 'same';

                }else{

                $ch = DB::table('lawyer__cases')->where('lawyer', $this->referee)->count();
                if($ch == 0){
                    $add =  DB::table('lawyer__cases')->insert(['lawyer' => $this->referee, 'open_cases' => 1]);
                }else{
                    $val = DB::table('lawyer__cases')->where('lawyer', $this->referee)->value('open_cases');
                    $newVal = $val + 1;
                    $inc = DB::table('lawyer__cases')->where('lawyer', $this->referee)->update(['open_cases' => $newVal]);
                }

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
