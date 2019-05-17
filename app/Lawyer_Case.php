<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Lawyer_Case extends Model
{
    protected $table = 'lawyer__cases';

    public function checkLawyerCases(){
        $check = DB::table($this->table)->where(['lawyer' => $this->lawyer])->count();

        if($check == 0){
            return false;
        }else{
            $intakes = DB::table($this->table)->where(['lawyer' => $this->lawyer])->value('intakes');
            return $intakes;
        }

    }

    public function addRecord(){

        $add = DB::table($this->table)->insert(['lawyer' => $this->lawyer, 'intakes' => 1]);
        return $add;
    }

    public function incrementValue(){

        $inc = DB::table($this->table)->where(['lawyer' => $this->lawyer])->update(['intakes' => $this->newValue]);
        return $inc;
    }

    public function addOpenCount(){
        $getOpen = DB::table($this->table)->where(['lawyer' => $this->lawyer])->value('open_cases');

        $newValue = $getOpen + 1;

        $addOpenCount = DB::table($this->table)->where(['lawyer' => $this->lawyer])->update(['open_cases' => $newValue]);

        return $addOpenCount;
    }
    public function addClosedCount(){
        $getOpen = DB::table($this->table)->where(['lawyer' => $this->lawyer])->value('closed_cases');

        $newValue = $getOpen + 1;

        $addOpenCount = DB::table($this->table)->where(['lawyer' => $this->lawyer])->update(['closed_cases' => $newValue]);

        return $addOpenCount;
    }

    public function decRecord(){

        $getOpen = DB::table($this->table)->where(['lawyer' => $this->lawyer])->value('open_cases');

        $newValue = $getOpen - 1;

        $addOpenCount = DB::table($this->table)->where(['lawyer' => $this->lawyer])->update(['open_cases' => $newValue]);

        return $addOpenCount;

    }

    public function decrementRecords(){

        $coll = DB::table('legal_case__staffs')->where('case_id', $this->case_id)->get();

        foreach($coll as $col){
            if($col->assignee == null){
                // if the case was not assigned to another lawyer
                $this->lawyer = $col->owner;
                $this->decRecord();
                $this->addClosedCount();

                if($col->referee1 != null){
                    $this->lawyer = $col->referee1;
                    $this->decRecord();
                    $this->addClosedCount();

                }
                if($col->referee2 != null){
                    $this->lawyer = $col->referee2;
                    $this->decRecord();
                    $this->addClosedCount();

                }
            }else{
                // if the case was assigned to someone
                $this->lawyer = $col->assignee;
                $this->decRecord();
                $this->addClosedCount();


                if($col->referee1 != null){
                    $this->lawyer = $col->referee1;
                    $this->decRecord();
                    $this->addClosedCount();

                }
                if($col->referee2 != null){
                    $this->lawyer = $col->referee2;
                    $this->decRecord();
                    $this->addClosedCount();

                }
            }




        }


    }

}
