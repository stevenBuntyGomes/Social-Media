<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class About extends JsonResource
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
                'type' => 'about',
                'about_id' => $this->id,
                'attributes' => [
                    'user_info' => new UserResource($this->user),
                    'study_place' => $this->study_place,
                    'work_place' => $this->work_place,
                    'business' => $this->business,
                    'Location' => $this->Location,
                    'contact' => $this->contact,
                ],
            ],
            'links' => [
                'self' => url('/about' . '/' . $this->id)
            ]
        ];
    }
}
