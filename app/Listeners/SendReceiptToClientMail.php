<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendReceiptToClient;
use App\Mail\SentReceiptMail;
class SendReceiptToClientMail
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
     * @param  SendReceiptToClient  $event
     * @return void
     */
    public function handle(SendReceiptToClient $event)
    {
        Mail::to($event->recipient)->send(new SentReceiptMail($event->attachment, $event->data));
    }
}
