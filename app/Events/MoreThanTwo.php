<?php


namespace App\Events;


use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;


class MoreThanTwo extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user;
    public function __construct()
    {
        $this->user=Auth::user();
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
