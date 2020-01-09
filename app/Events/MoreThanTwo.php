<?php


namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class MoreThanTwo extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return void
     */
    public function broadcastOn()
    {
//        return new PrivateChannel('channel-name');
    }
}
