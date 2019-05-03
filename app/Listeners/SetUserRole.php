<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SetUserRole
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {   
        $event->user->role = ($event->user->id === 1 || $event->user->id % 3 === 0)
            ? $event->user->role = 'ADMIN'
            : $event->user->role = 'USER';

        $event->user->save();
    }
}
