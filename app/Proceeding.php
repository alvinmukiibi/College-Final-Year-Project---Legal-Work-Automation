<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\LegalCase;
use Illuminate\Support\Facades\DB;
class Proceeding extends Model
{
    protected $table ='proceedings';

    public function legalcase()
    {
        return $this->belongsTo(LegalCase::class);
    }

    public function addProceeding(){
        $data = $this->data;
        return DB::table($this->table)->insert(['description' => $data['description'] , 'date_of_proceeding' => $data['date_of_proceeding'], 'court_of_proceeding' => $data['court'], 'date_of_next_proceeding' => $data['date_of_next_proceeding'], 'outcome_of_proceeding' => $data['outcome'], 'case_id' =>$this->case_id ]);

    }
    public function testProc(){
        $proceedings = DB::table('proceedings')->where('date_of_next_proceeding', '>', date('Y-m-d'))->get();
           dd($proceedings);
    }


}
