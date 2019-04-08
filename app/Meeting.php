<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Meeting extends Model
{
    protected $table = "meetings";



    public function scheduleMeeting(){
        $data = $this->data;
        $scheduled = DB::table($this->table)->insert(['name' => $data['name'], 'agenda' => $data['agenda'], 'date' => $data['date'], 'time' => $data['time'], 'venue' => $data['venue'], 'attendance' => $data['attendee'], 'scheduledBy' => $this->scheduledBy, 'firm_id' => $this->firm_id]);
        return $scheduled;

    }
}
