<?php

namespace App\Listeners\TeamHasCompleted;

use App\Events\TeamHasCompleted;
use App\Mail\TeamMemberNotification;
use function dd;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailNotification
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
     * @param  TeamHasCompleted  $event
     * @return void
     */
    public function handle(TeamHasCompleted $event)
    {
        Mail::to($event->user)->send(new TeamMemberNotification($event->user));
    }
}
