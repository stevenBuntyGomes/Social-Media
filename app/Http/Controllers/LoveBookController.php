<?php

namespace App\Http\Controllers;

use App\User;
use App\LoveBook;
use App\Book;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\LoveBookCollection as LoveBookCollection;
use App\Events\BookLove;
use App\Events\NewBookNotification;

class LoveBookController extends Controller
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
        $book = Book::where('id', $book_id)->first();
        $book->loveBook()->toggle(auth()->user());

        $loveBook = LoveBook::where('book_id', $book->id)->where('user_id', Auth()->id())->first();

        if($loveBook !== null){
            // $user = User::where('id', $book->user_id)->first();
            // broadcast(new BookLove($user));

            // loveBook Notification start

            if($book->user_id !== Auth()->id()){
                $notification = Notification::create([
                    'from' => Auth()->id(),
                    'to' => $book->user_id,
                    'notification_type' => 'book',
                    'book_id' => $book->id,
                    'post_id' => null,
                    'status' => 7,
                ]);
                broadcast(new NewBookNotification($notification));
            }


            // loveBook Notification ends
        }

        return new LoveBookCollection($book->loveBook);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LoveBook  $loveBook
     * @return \Illuminate\Http\Response
     */
    public function show(LoveBook $loveBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LoveBook  $loveBook
     * @return \Illuminate\Http\Response
     */
    public function edit(LoveBook $loveBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LoveBook  $loveBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LoveBook $loveBook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LoveBook  $loveBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoveBook $loveBook)
    {
        //
    }
}
