<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Post as PostResource;

class Notification extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                'type' => 'notification',
                'notification_id' => $this->id,
                'attributes' => [
                    'from' => new UserResource($this->fromUser),
                    'to' => new UserResource($this->toUser),
                    'notification_type' => $this->notification_type,
                    'book' => new BookResource($this->book),
                    'post' => new PostResource($this->post),
                    'status' => $this->status,
                    'posted_at' => $this->created_at->diffForHumans(),
                ],
            ],
            'links' => [
                'self' => url('/notifications' . '/' . $this->id)
            ]
        ];
    }
}
