<?php

namespace App\Listeners;

use App\Events\GetPoints;
use App\Ranks;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateRank
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
     * @param  GetPoints  $event
     * @return void
     */
    public function handle(GetPoints $event)
    {
        Ranks::updateOrCreate([
            'username' => $event->user_name,
        ],[
            'username' => $event->user_name,
            'points' => ($event->user_all_correct * 100)
        ]);
    }
}
