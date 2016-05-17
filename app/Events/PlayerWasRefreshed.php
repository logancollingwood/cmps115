<?php

namespace App\Events;

use App\Player;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PlayerWasRefreshed extends Event implements ShouldBroadcast
{
    use SerializesModels;

    private $player;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($player)
    {
        //
        $this->player = $player;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['player.'.$this->player->summonerName];
    }
}
