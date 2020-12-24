<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\Exceptions\FriendRequestNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FriendRequestResponseController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'user_id' => 'required',
            'status' => 'required',
        ]);
        try {
            $friendRequest = Friend::where('user_id', $data['user_id'])
            ->where('friend_id', auth()->user()->id) //this line means the person is being friend requested [this is very important piece of code. without it, anybody can accept friend request]
            ->firstOrFail();
        } catch(ModelNotFoundException $e){
            throw new FriendRequestNotFoundException;
        }



        $friendRequest->update(array_merge($data, [
            'confirmed_at' => now(),
        ]));

        return new FriendResource($friendRequest);
    }


    public function destroy(){

        $data = request()->validate([
            'user_id' => 'required',
        ]);
            try {
                Friend::where('user_id', $data['user_id'])
                    ->where('friend_id', auth()->user()->id) //this line means the person is being friend requested [this is very important piece of code. without it, anybody can accept friend request]
                    ->firstOrFail()
                    ->delete();
            } catch(ModelNotFoundException $e){
                throw new FriendRequestNotFoundException;
            }


        return response()->json([], 204);
    }
}
