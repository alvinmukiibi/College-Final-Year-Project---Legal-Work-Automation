<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FirmVerifyEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $firm_name;
    public $firm_otp;
    public $firm_uuid;
    /** 
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($firm_name, $firm_otp, $firm_uuid)
    {
        $this->firm_name = $firm_name;
        $this->firm_otp = $firm_otp;
        $this->firm_uuid = $firm_uuid;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('utils.mails.emailVerified');
    }
}
