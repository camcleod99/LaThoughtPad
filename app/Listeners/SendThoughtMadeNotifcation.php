<?php

namespace App\Listeners;

use App\Events\ThoughtMade;
use App\Models\User;
use App\Notifications\NewThought;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendThoughtMadeNotifcation implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ThoughtMade $event): void
    {
        foreach (User::whereNot('id', $event->thought->user_id)->cursor() as $user){
            $user->notify(new NewThought($event->thought));
        }
        //
    }
}
