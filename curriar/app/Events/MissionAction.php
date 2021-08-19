<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MissionAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mission_ids;
    public $status_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($status_id, $mission_ids  = [])
    {
        $this->status_id = $status_id;
        $this->mission_ids = $mission_ids;
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
