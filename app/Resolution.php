<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proceeding;
class Resolution extends Model
{
    protected $table = 'resolutions';

    public function proceeding()
    {
        return $this->belongsTo(Proceeding::class);
    }
}
