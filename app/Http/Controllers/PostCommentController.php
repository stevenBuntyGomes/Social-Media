<?php

namespace App\Http\Controllers;
use App\Comment;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Http\Resources\CommentCollection;
use App\Events\CommentNotification;
use App\Notification;
use App\Events\NewBookNotification;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Post $post)
    {
        $data = request()->validate([
            'body' => 'required',
        ]);

        $post->comments()->create(array_merge($data, [
            'user_id' => auth()->user()->id,
        ]));

        // $user = User::where('id', $post->user_id)->first();
        // broadcast(new CommentNotification($user));

        if($post->user_id !== Auth()->id()){
                $notification = Notification::create([
                    'from' => Auth()->id(),
                    'to' => $post->user_id,
                    'notification_type' => 'post',
                    'book_id' => null,
                    'post_id' => $post->id,
                    'status' => 4,
                ]);
                broadcast(new NewBookNotification($notification));
            }

        return new CommentCollection($post->comments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
