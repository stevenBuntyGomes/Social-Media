<?php

namespace App\Http\Controllers;

use App\BookComment;
use App\Notification;
use Illuminate\Http\Request;
use App\Book;
use App\User;
use App\Http\Resources\BookCommentCollection as BookCommentCollection;
use App\Events\BookCommentNotification;
use App\Events\NewBookNotification;

class BookCommentController extends Controller
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
    public function store($book_id)
    {
        $data = request()->validate([
            'body' => 'required',
        ]);

        $book = Book::where('id', $book_id)->first();
        $book->book_comments()->create(array_merge($data, [
            'user_id' => Auth()->id(),
        ]));

        // $user = User::where('id', $book->user_id)->first();

        // broadcast(new BookCommentNotification($user));
        // book comment notification starts

        if($book->user_id !== Auth()->id()){
                $notification = Notification::create([
                    'from' => Auth()->id(),
                    'to' => $book->user_id,
                    'notification_type' => 'book',
                    'book_id' => $book->id,
                    'post_id' => null,
                    'status' => 8,
                ]);
                broadcast(new NewBookNotification($notification));
            }
        // book comment notification ends

        return new BookCommentCollection($book->book_comments);
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function show(BookComment $bookComment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function edit(BookComment $bookComment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookComment $bookComment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookComment  $bookComment
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookComment $bookComment)
    {
        //
    }
}
