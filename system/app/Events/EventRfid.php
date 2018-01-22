<?php

namespace App\Events;

use App\Rfid;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EventRfid implements ShouldBroadcast
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
        $Rfid = Rfid::all();
        $data = [];
        foreach ($Rfid as $key) {
            if ($key->rfid_user != null)
                $key->rfid_user = User::where('id', $key->rfid_user)->get()[0]->name;
            $data[] = $key;
        }
        $this->data = ['rfid' => $data];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return ['rfid-channel'];
    }
}
