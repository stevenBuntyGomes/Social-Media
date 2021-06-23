<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\LoveBookCollection as LoveBookCollection;
use App\Http\Resources\BookCommentCollection as BookCommentCollection;

class Book extends JsonResource
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
                'type' => 'mybook',
                'book_id' => $this->id,
                'attributes' => [
                    'posted_by' => new UserResource($this->user),
                    'comments' => new BookCommentCollection($this->book_comments),
                    'loves' => new LoveBookCollection($this->loveBook),
                    'book_name' => $this->book_name,
                    'book_page' => $this->book_page,
                    'book_unique_name' => $this->book_unique_name,
                    'book_title_image' => url('./storage' . '/book-image' . '/' . $this->book_title_image),
                    'book_image_name' => $this->book_title_image,
                    'book_tags' => $this->book_tags,
                    'posted_at' => $this->created_at->diffForHumans(),
                    'bookKey' => $this->bookKey,
                ],
            ],
            'links' => [
                'self' => url('/books' . '/' . $this->id)
            ]
        ];
    }
}
