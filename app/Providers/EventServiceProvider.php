<?php

namespace App\Providers;

use App\Observers\AuditObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        $this->auditObservers();
    }

    /**
     * Register the audit observer for the models.
     *
     * @return void
     */
    private function auditObservers()
    {
        \App\Models\Billing\User\User::observe(AuditObserver::class);
        /** @todo Register others models observes */
    }
}
