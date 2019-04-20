<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;

class SendReceiptToClient
{
    use Dispatchable, SerializesModels;


    public $recipient;
    public $attachment;
    public $data;
    public function __construct()
    {

    }


}
