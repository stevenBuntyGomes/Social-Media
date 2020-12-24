<?php

namespace App\Http\Controllers;

use App\User;
use App\Friend;
use Illuminate\Http\Request;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\ValidationErrorException;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Friend as FriendResource;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class FriendRequest extends Controller
{
    public function store(){
            $data = request()->validate([
                'friend_id' => 'required',
            ]);

        try {
            User::findOrFail($data['friend_id'])->friends()->syncWithoutDetaching(auth()->user()); //attach method will attach over and over again
        } catch (ModelNotFoundException $e){
            throw new UserNotFoundException();
        }

        // Friend::create($data);
        return new FriendResource(
            Friend::where('user_id', auth()->user()->id)
                ->where('friend_id', $data['friend_id'])->first()
        );
    }
}
