<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\LegalCase;
class File extends Model
{
    protected $table = 'files';

    public function legalcase(){
        return $this->belongsTo(LegalCase::class);
    }

    public function saveFile(){
        $data = $this->data;
        $save = DB::table($this->table)->insert(['name' => $data['name'],'location' => $this->location, 'case_id' => $this->case_id, 'uploadedBy' => auth()->user()->id]);
        return $save;
    }
    public function getCaseDocuments(){
        return DB::table($this->table)->join('users', 'users.id', '=', 'files.uploadedBy')->where(['case_id' => $this->case_id])->select('files.*', 'users.fname', 'users.lname')->orderBy('date_of_upload', 'desc')->get();

    }
}
