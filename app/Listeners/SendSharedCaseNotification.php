<?php

namespace App\Listeners;
use App\Events\CaseShared;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SharedCaseNotification;
class SendSharedCaseNotification
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
     * @param  CaseShared  $event
     * @return void
     */
    public function handle(CaseShared $event)
    {
        Mail::to($event->sharee->email)->send(new SharedCaseNotification($event->data, $event->case_id, $event->sharer, $event->sharee));

    }
}
