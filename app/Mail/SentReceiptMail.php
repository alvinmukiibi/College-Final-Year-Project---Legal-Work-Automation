<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $attachment;
    public $data;
    public function __construct($attachment, $data)
    {
        $this->attachment = $attachment;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('utils.mails.paymentReceiptSent')->attachData($this->attachment->output(), 'Receipt#_'.$this->data['payment']->ref.'.pdf', ['mime' => 'application/pdf']);
    }
}
