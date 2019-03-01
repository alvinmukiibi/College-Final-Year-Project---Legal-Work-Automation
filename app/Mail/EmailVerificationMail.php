<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerificationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $firm_name;
    protected $firm_otp;
    protected $token;

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
        $this->token = bcrypt($this->firm_otp);
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    
    {
        $data  = [
            'firm_name'=>$this->firm_name,
            'firm_otp'=>$this->firm_otp,
            'token'=>$this->token
        ];
        return $this->view("utils.mails.firmVerification")->with($data);

    }
}
