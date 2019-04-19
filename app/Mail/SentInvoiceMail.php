<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SentInvoiceMail extends Mailable
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
        return $this->markdown('utils.mails.invoiceSent')->attachData($this->attachment->output(), 'Invoice#_'.$this->data['invoice']->invoice_no.'.pdf', ['mime' => 'application/pdf']);
    }
}
