<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookImage extends JsonResource
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
                'attributes' => [
                    'image_name' => $this->image,
                    'image_src' => url('./storage' . '/book-image' . '/' . $this->image),
                ],
            ],
        ];
    }
}
