<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use App\Events\UserRegistered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\UserVerifyEmail;

class SendUserVerificationMail
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        Mail::to($event->data['email'])->send(new UserVerifyEmail($event->data['name'], $event->data['otp'], $event->data['token']));

    }
}
