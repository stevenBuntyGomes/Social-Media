<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection as PostCollection;
use App\Friend;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function index(){
        $friends = Friend::friendships();
        if($friends->isEmpty()){
            return new PostCollection(request()->user()->posts);
        }
        return new PostCollection(
            Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
                ->get()
        );


        // $posts = Post::orderBy('id', 'desc')->get();
        // return response($posts);
        // $posts = Post::orderBy('id', 'desc')->get();
        // // $posts = Post::all();
        // return response()->json($posts);
    }

    public function store(){
        // $data = request()->validate([
        //     'data.attributes.body' => '',
        // ]);
        $data = request()->validate([
            'body' => '',
            'image' => '',
            'width' => '',
            'height' => '',
        ]);

        // dd($data);

        if(isset($data['image'])){
            $image = $data['image']->store('post-images', 'public');

            Image::make($data['image'])
                ->fit($data['width'], $data['height'])
                ->save(storage_path('app/public/post-images/' . $data['image']->hashName()));
        }

        //$post = request()->user()->posts()->create($data['data']['attributes']);
        $post = request()->user()->posts()->create([
            'body' => $data['body'],
            'image' => $image ?? null, //?? is or operator

        ]);
        return new PostResource($post);
    }



}
