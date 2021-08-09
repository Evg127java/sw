<?php

namespace App\Listeners;

use App\Jobs\SendWelcomeMailJob;
use Illuminate\Auth\Events\Verified;

class SendWelcomeMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param Verified $event
     * @return void
     */
    public function handle(Verified $event)
    {
        /* Send the job to the default queue */
        $user = $event->user;
        SendWelcomeMailJob::dispatch($user)->delay(now()->addSeconds(15));
    }
}
