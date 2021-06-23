<?php

namespace App\Events;

use App\User;
use App\Book;
use App\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Notification as NotificationResource;

class NewBookNotification implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $auth;
    public $notification;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notification $notification)
    {
        $this->user = User::where('id', $notification->to)->first();
        $this->auth = User::where('id', Auth()->id())->first();
        $this->notification = $notification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('NewBookNotification.' . $this->user->id);
    }
    //problem is code below
    public function broadcastWith(){
        return [ 'book_notification' => new NotificationResource($this->notification)];
    }
}
