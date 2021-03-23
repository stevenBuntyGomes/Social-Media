<?php

namespace App\Events;
use App\Friend;
use App\User;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\User as UserResource;

class AcceptFriendRequest implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $friend;
    public $user;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Friend $friend)
    {
        $this->friend = $friend;
        $this->user = User::where('id', $friend->friend_id)->first();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('acceptFriendRequest.' . $this->friend->user_id);
    }

    public function broadcastWith()
    {
        return ['accept_request' => new UserResource($this->user)];
    }
}