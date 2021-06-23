<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LoveBookCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
       return [
            'data' => $this->collection,
            'love_count' => $this->count(),
            //this is a method that is provided by laravel count()
            'user_love_book' => $this->collection->contains('id', auth()->user()->id),
            'links' => [
                'self' => url('/book'),
            ]
        ];
    }
}
