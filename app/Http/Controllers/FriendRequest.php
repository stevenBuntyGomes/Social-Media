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
use App\Events\NewFriendRequest;


class FriendRequest extends Controller
{
    public function store(){
        // laravel testing starts for validationException
        // try{
        //     $data = request()->validate([
        //         'friend_id' => 'required',
        //     ]);
        // } catch(ValidationException $e){
        //     // return response()->json([
        //     //     'errors' => [
        //     //         'code' => 422,
        //     //         'title' => 'Validation Error',
        //     //         'detail' => 'your request is malformed or missing fields',
        //     //         'meta' => $e->errors(),
        //     //     ]
        //     // ], 422);
        //     throw new ValidationErrorException(json_encode($e->errors()));
        // }
        // laravel testing ends for validationException
        $data = request()->validate([
            'friend_id' => 'required',
        ]);


        try {
            User::findOrFail($data['friend_id'])->friends()->syncWithoutDetaching(auth()->user()); //attach method will attach over and over again
            //syncWIthoutDetaching will only ever make one record.. it will not allow same record to be stored twice
        } catch (ModelNotFoundException $e){
            throw new UserNotFoundException();
        }

        // Friend::create($data);
        $friend = Friend::where('user_id', auth()->user()->id)
                ->where('friend_id', $data['friend_id'])->first();
        broadcast(new NewFriendRequest($friend));

        return new FriendResource(
            Friend::where('user_id', auth()->user()->id)
                ->where('friend_id', $data['friend_id'])->first()
        );




    }
}
