<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use App\Events\FirmRegistered;
use App\Events\UserRegistered;
use App\Events\MeetingScheduled;
use App\Events\CaseShared;
use App\Events\SendReceiptToClient;
use App\Events\SendInvoiceToClient;
use App\Events\FirmContacted;
use App\Listeners\SendVerificationMail;
use App\Listeners\SendUserVerificationMail;
use App\Listeners\SendNewMeetingNotification;
use App\Listeners\SendSharedCaseNotification;
use App\Listeners\SendReceiptToClientMail;
use App\Listeners\SendInvoiceToClientMail;
use App\Listeners\SendFirmContactedNotification;
use App\Listeners\UserEventSubscriber;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        FirmRegistered::class => [
            SendVerificationMail::class
        ],
        UserRegistered::class => [
            SendUserVerificationMail::class
        ],
        MeetingScheduled::class => [
            SendNewMeetingNotification::class
        ],
        CaseShared::class => [
            SendSharedCaseNotification::class
        ],
        SendReceiptToClient::class => [
            SendReceiptToClientMail::class
        ],
        SendInvoiceToClient::class => [
            SendInvoiceToClientMail::class
        ],
        FirmContacted::class => [
            SendFirmContactedNotification::class
        ],



    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */

    public $subscribe = [
        'App\Listeners\UserEventSubscriber',
    ];

    public function boot()
    {
        parent::boot();

        //
    }
}
