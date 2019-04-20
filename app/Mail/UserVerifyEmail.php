<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $otp;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $otp, $token)
    {
        $this->name = $name;
        $this->otp = $otp;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('utils.mails.userEmailVerified');
    }
}
