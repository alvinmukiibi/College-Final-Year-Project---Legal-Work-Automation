<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;

class UserRegistered
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }
}
