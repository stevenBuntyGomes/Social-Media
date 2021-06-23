<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoveBook extends JsonResource
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
                'type' => 'love_books',
                'love_book_id' => $this->id,
                'attributes' => [],
            ],
            'links' => [
                'self' => url('/book' . '/' . $this->pivot->book_id),
            ]
        ];
    }
}
