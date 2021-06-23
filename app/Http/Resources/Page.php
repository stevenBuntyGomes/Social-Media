<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Page extends JsonResource
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
                'type' => 'post',
                'page_id' => $this->id,
                'attributes' => [
                    // 'posted_by' => new UserResource($this->user),
                    'book_id' => $this->book_id,
                    'user_id' => $this->user_id,
                    'page_no' => $this->page_no,
                    'book_unique_name' => $this->book_unique_name,
                    'image' => url('./storage' . '/book-pages' . '/' . $this->page_image),
                    'image_name' => $this->page_image,
                    'posted_at' => $this->created_at->diffForHumans(),
                ],
            ],
            'links' => [
                'self' => url('/pages' . '/' . $this->id)
            ]
        ];
    }
}
