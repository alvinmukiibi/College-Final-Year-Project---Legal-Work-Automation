<?php

namespace App\Listeners;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SendInvoiceToClient;
use App\Mail\SentInvoiceMail;
class SendInvoiceToClientMail
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
     * @param  SendInvoiceToClient  $event
     * @return void
     */
    public function handle(SendInvoiceToClient $event)
    {
        Mail::to($event->recipient)->send(new SentInvoiceMail($event->attachment, $event->data));
    }
}
