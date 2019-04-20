<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SharedCaseNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public $case_id;
    public $sharer;
    public $sharee;
    public function __construct($data, $case_id, $sharer, $sharee)
    {
        $this->data = $data;
        $this->case_id = $case_id;
        $this->sharer = $sharer;
        $this->sharee = $sharee;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('utils.mails.shareeCaseNotified');
    }
}
