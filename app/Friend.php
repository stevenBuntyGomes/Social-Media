<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $guarded = [];
    protected $dates = [
        'confirmed_at'
    ];

    public static function friendship($userId){
        return (new static())
            ->where(function($query) use ($userId) {
                return $query->where('user_id', auth()->user()->id) //user_id = authenticated user_id
                    ->where('friend_id', $userId); // friend_id = user_id that got passed in
            })
            ->orWhere(function($query) use ($userId) {
                return $query->where('friend_id', auth()->user()->id) // friend_id = authenticated user_id
                    ->where('user_id', $userId); // user_id = user_id that got passed in
            })->first();
    }


    public static function friendships(){
       return (new static())
        ->whereNotNull('confirmed_at')
        ->where(function ($query) {
            return $query->where('user_id', auth()->user()->id)
            ->orWhere('friend_id', auth()->user()->id);
        })->get();
    }
}
