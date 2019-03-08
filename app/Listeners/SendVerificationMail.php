<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\FirmRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\FirmVerifyEmail;

class SendVerificationMail
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
     * @param  FirmRegistered  $event
     * @return void
     */
    public function handle(FirmRegistered $event)
    {
        //so we can dispatch a job queue here to allow the system run faster
        Mail::to($event->firm['email'])->send(new FirmVerifyEmail($event->firm['name'], $event->firm['otp'], $event->firm['uuid']));
        
}
}
