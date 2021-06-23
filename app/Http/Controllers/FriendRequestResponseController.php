<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\Http\Resources\Friend as FriendResource;
use App\Exceptions\FriendRequestNotFoundException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Events\AcceptFriendRequest;
use App\Notification;
use App\Events\NewBookNotification;

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
        //merging the $data array and Friend::model array together
        //this way the confirmed_at will join with user_id and status together

        // broadcast(new AcceptFriendRequest($friendRequest));

        // frienRequest accept notification starts
        $notification = Notification::create([
                    'from' => Auth()->id(),
                    'to' => $data['user_id'],
                    'notification_type' => 'Friend Request Accepted',
                    'book_id' => null,
                    'post_id' => null,
                    'status' => 2,
                ]);
                broadcast(new NewBookNotification($notification));
        // frienRequest accept notification ends
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


    public function unfriend(){
        $data = request()->validate([
            'user_id' => 'required',
        ]);

        $user_id = $data['user_id'];

        try {
            Friend::where(function($q) use($user_id){
                $q->where('user_id', Auth()->id());
                $q->where('friend_id', $user_id);
            })->orWhere(function($q) use ($user_id){
                $q->where('friend_id', Auth()->id());
                $q->where('user_id', $user_id);
            })->first()->delete();
        } catch(ModelNotFoundException $e){
            throw new FriendRequestNotFoundException;
        }

        return response()->json([], 204);

    }
}
