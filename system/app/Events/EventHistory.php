<?php

namespace App\Events;

use App\History;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventHistory implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $data;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $history = History::all();
        $data = [];
        foreach ($history as $key) {
            $key->username = User::where('username', $key->username)->get()[0]->name;
            $data[] = $key;
        }
        $this->data = ['history' => $data];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['history-channel'];
    }
}
