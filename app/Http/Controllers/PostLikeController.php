<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\LikeCollection;

class PostLikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->toggle(auth()->user()); //parenthesis means query of data

        return new LikeCollection($post->likes); // no parenthesis means only data no query
    }
}