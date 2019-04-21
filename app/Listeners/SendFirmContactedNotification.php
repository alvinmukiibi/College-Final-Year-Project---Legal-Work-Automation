<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\FirmContacted;
use App\Mail\SentFirmContactedMail;
class SendFirmContactedNotification
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
     * @param  FirmContacted  $event
     * @return void
     */
    public function handle(FirmContacted $event)
    {
        Mail::to($event->firm->email)->send(new SentFirmContactedMail($event->data, $event->firm));
    }
}
