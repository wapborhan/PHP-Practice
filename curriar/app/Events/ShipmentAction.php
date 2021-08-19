<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ShipmentAction
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $shipment_ids;
    public $status_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($status_id, $shipment_ids  = [])
    {
        $this->status_id = $status_id;
        $this->shipment_ids = $shipment_ids;
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
