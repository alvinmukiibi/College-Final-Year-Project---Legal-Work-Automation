<?php

namespace App\Listeners;
use App\Events\MeetingScheduled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewMeetingNotification;

class SendNewMeetingNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  MeetingScheduled  $event
     * @return void
     */
    public function handle(MeetingScheduled $event)
    {
        Mail::to($event->recipient->email)->send(new NewMeetingNotification($event->recipient, $event->details, $event->sender));

    }
}
