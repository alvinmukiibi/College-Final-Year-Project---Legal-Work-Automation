<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $firm_name;
    public $firm_otp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firm_name, $firm_otp)
    {
        //
        $this->firm_name = $firm_name;
        $this->firm_otp = $firm_otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view("utils.mails.firmVerification");

    }
}
