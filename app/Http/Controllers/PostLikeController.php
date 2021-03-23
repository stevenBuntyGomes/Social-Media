<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\LikeCollection;
use App\User;
use App\Events\LikeNotification;
use App\Like;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->toggle(auth()->user()); //parenthesis means query of data
        //toggle means one click like true another click like false
        $like = Like::where('post_id', $post->id)->where('user_id', Auth()->id())->first();
        if($like !== null){
            $user = User::where('id', $post->user_id)->first();
            broadcast(new LikeNotification($user));
        }

        //toggle means one click like true another click like false
        //the particular like query will be deleted from database after toggle false like


        return new LikeCollection($post->likes); // no parenthesis means only data no query
    }
}
