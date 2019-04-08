<?php

namespace App\Events;


use Illuminate\Queue\SerializesModels;

use Illuminate\Foundation\Events\Dispatchable;


class MeetingScheduled
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $details;
    public $recipient;
    public $sender;
    public function __construct()
    {

    }


}
