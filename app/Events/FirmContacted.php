<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;

class FirmContacted
{
    use Dispatchable, SerializesModels;


    public $data;
    public $firm;
    public function __construct()
    {

    }


}
