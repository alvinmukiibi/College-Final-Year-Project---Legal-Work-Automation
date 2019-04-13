<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;

class CaseShared
{
    use Dispatchable, SerializesModels;


    public $data;
    public $case_id;
    public $sharer;
    public $sharee;
    public function __construct()
    {

    }


}
