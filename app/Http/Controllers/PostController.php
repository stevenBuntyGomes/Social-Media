<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\PostCollection as PostCollection;
use App\Friend;
use Intervention\Image\Facades\Image;
use App\User;
use App\Events\PostNotification;

class PostController extends Controller
{

    public function index(){
        $friends = Friend::friendships();
        if($friends->isEmpty()){
            return new PostCollection(request()->user()->posts);
        }
        return new PostCollection(
            Post::whereIn('user_id', $friends->pluck('user_id'))->orWhereIn('user_id', $friends->pluck('friend_id'))->get()
        );
        // Post::whereIn('user_id', [$friends->pluck('user_id'), $friends->pluck('friend_id')])
        //         ->get()


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

        $friends = Friend::friendships();
        $postUsers = User::whereIn('id', $friends->pluck('user_id'))->orWhereIn('id', $friends->pluck('friend_id'))->where('id', '!=', Auth()->id())->get();

        foreach($postUsers as $user){
            if($user->id == Auth()->id()){
                continue;
            }else{
                broadcast(new PostNotification($user));
            }

        }

        return new PostResource($post);
    }


    public function update(){
        $data = request()->validate([
            'body' => 'required',
            'post_id' => 'required',
            'image' => '',
            'width' => '',
            'height' => '',
        ]);

        $post = Post::where('id', $data['post_id'])->first();
        //Post::where('id', $data['post_id'])->first();

        if(isset($data['image'])){
            if($post->image != null){
                unlink(storage_path('app/public/' . $post->image));
            }

            $image = $data['image']->store('post-images', 'public');
            Image::make($data['image'])
                ->fit($data['width'], $data['height'])
                ->save(storage_path('app/public/post-images/' . $data['image']->hashName()));

            Post::where('id', $data['post_id'])->update([
                'body' => $data['body'],
                'image' => $image ?? null,
            ]);

            $updatedPost = Post::where('id', $data['post_id'])->first();

            return new PostResource($updatedPost);

        }elseif(!isset($data['image'])){
            Post::where('id', $data['post_id'])->update([
                'body' => $data['body'],
            ]);

            $updatedPost = Post::where('id', $data['post_id'])->first();

            return new PostResource($updatedPost);

        }


    }


    // delete post permanently
    public function deletePost(){
        $data = request()->validate([
            'post_id' => 'required',
            'postKey' => 'required',
        ]);

        Post::where('id', $data['post_id'])->delete();
        
        return response()->json('post has been deleted');
    }



}
