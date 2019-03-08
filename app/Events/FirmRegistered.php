<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;

class FirmRegistered
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $firm;
    public function __construct($firm)
    {
        $this->firm = $firm;
    }
}

  
