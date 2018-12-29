<?php

namespace App\Events;

use App\Users\UserStat;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GetPoints
{
    use  SerializesModels;
    public $user_all_correct;
    public $user_name;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user_id , $user_name)
    {
      $this->user_name = $user_name;
      $this->user_all_correct = UserStat::where(['user_id' => $user_id , 'question_result' => 1])
                ->sum('question_result');
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
