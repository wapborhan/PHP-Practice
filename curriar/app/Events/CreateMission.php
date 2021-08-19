<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateMission
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $mission;
    public $shipments;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($mission ,$shipments = [])
    {
        $this->mission = $mission;
        $this->shipments = $shipments;
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
