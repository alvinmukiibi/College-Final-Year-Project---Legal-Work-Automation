<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class File extends Model
{
    protected $table = 'files';

    public function addFile(){
        $add = DB::table($this->table)->insert(['description' => $this->description, 'location' => $this->location, 'case_id' => $this->case_id, 'due_diligence_id' => $this->due_diligence_id]);
        return $add;
    }
}
