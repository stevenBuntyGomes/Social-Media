<?php

namespace App\Http\Controllers;

use App\Book;
use App\Page;
use App\User;
use App\Friend;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\Page as PageResource;
use App\Http\Resources\Image as ImageResource;
use App\Http\Resources\BookImage as BookImageResource;
use Intervention\Image\Facades\Image;
use App\Classes\ImageObj;
use App\Http\Resources\BookCollection as BookCollection;
use App\Http\Resources\PageCollection as PageCollection;
use App\Events\NewBookNotification;
use App\Http\Resources\Notification as NotificationResource;
use App\Http\Resources\NotificationCollection as NotificationCollection;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($book_id)
    {
        $user_book = Book::where('id', $book_id)->first();
        $book_pages = Page::where('book_id', $book_id)->get();

        return view('books/mybook', [
            'user_book' => $user_book,
            'book_pages' => $book_pages,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function bookFeed(){
        $friends = Friend::friendships();
        if($friends->isEmpty()){
            // return new BookCollection(request()->user()->Books);
            $user = User::where('id', Auth()->id())->first();
            return new BookCollection($user->Books);
        }
        return new BookCollection(
            Book::whereIn('user_id' , $friends->pluck('user_id'))->orWhereIn('user_id', $friends->pluck('friend_id'))->get()
        );
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUserBooks(){
        $data = request()->validate([
            'user_id' => 'required'
        ]);

        $user = User::where('id', $data['user_id'])->first();
        return new BookCollection($user->Books);
        // return $user->Books;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createBook()
    {
        $data = request()->validate([
            'userId' => 'required',
            'bookName' => 'required',
            'bookPage' => 'required',
            'bookUniqueName' => 'required',
            'bookTitleImage' => 'required',
            'bookTagsName'  => 'required',
        ]);


        $Book = request()->user()->Books()->create([
            'book_name' => $data['bookName'],
            'book_page' => $data['bookPage'],
            'book_unique_name' => $data['bookUniqueName'],
            'book_title_image' => $data['bookTitleImage'],
            'book_tags' => $data['bookTagsName'],
        ]);


        // broadcasting new Book using private channel starts

        $friends = Friend::friendships();
        $broadcastUser = User::whereIn('id', $friends->pluck('user_id'))->orWhereIn('id', $friends->pluck('friend_id'))->get();

        foreach($broadcastUser as $user){
            if($user->id == Auth()->id()){
                continue;
            }else{
                $notification = Notification::create([
                    'from' => Auth()->id(),
                    'to' => $user->id,
                    'notification_type' => 'book',
                    'book_id' => $Book->id,
                    'post_id' => null,
                    'status' => 6,
                ]);
                broadcast(new NewBookNotification($notification));
            }
        }
        // broadcasting new Book using private channel ends

        return new BookResource($Book);
    }


    public function editBookToDB(){
        $data = request()->validate([
            'bookId' => 'required',
            'bookName' => 'required',
            'bookPage' => 'required',
            'bookUniqueName' => 'required',
            'bookTitleImage' => 'required',
            'bookTagsName' => 'required',
            'bookKey' => 'required',
        ]);


        Book::where('id', $data['bookId'])->update([
            'book_name' => $data['bookName'],
            'book_page' => $data['bookPage'],
            'book_unique_name' => $data['bookUniqueName'],
            'book_title_image' => $data['bookTitleImage'],
            'book_tags' => $data['bookTagsName'],
        ]);


        $updatedBook = Book::where('id', $data['bookId'])->first();

        return new BookResource($updatedBook);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function addImage(Request $request){
        $bookImage = Auth()->id() . '-' . str_replace(' ', '', $request->book_name) . '-' . time() . '.' . $request->file->extension();
        Image::make($request->file)
            ->save(storage_path('app/public/book-image/' . $bookImage));

        $imageObj = new ImageObj($bookImage);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new BookImageResource($imageObj);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePages(Request $request)
    {

        // image from post
        $picName = $request->index . '-' . $request->book_id . '-' . str_replace(' ', '', $request->book_unique_name) . '-' . time()  . '.' . $request->file->extension();
        // $image = $request->file->store('book-pages', 'public');

        Image::make($request->file)
                ->save(storage_path('app/public/book-pages/' . $picName));
        // image from post

        //
        $imageObj = new ImageObj($picName);
        // $request->file->move(storage_path('app/public/book-pages/'), $picName);
        // return response($picName);
        return new ImageResource($imageObj);
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */


    public function addPageDB(Request $request){
        $page = $request->validate([
            'book_id' => 'required|numeric',
            'book_unique_name' => 'required',
            'page_no' => 'required',
            'page_image' => 'required',
        ]);

        $page = request()->user()->Pages()->create([
            'user_id' => Auth()->id(),
            'book_id' => $page['book_id'],
            'book_unique_name' => $page['book_unique_name'],
            'page_no' => $page['page_no'],
            'page_image' => $page['page_image'],
        ]);
        return response('done');
    }


    public function editPageDB(Request $request){
        $page = $request->validate([
            'page_id' => 'required',
            'book_id' => 'required|numeric',
            'book_unique_name' => 'required',
            'page_no' => 'required',
            'page_image' => 'required',
        ]);

        Page::where('id', $page['page_id'])
            ->where('book_unique_name', $page['book_unique_name'])->update([
                'page_image' => $page['page_image'],
            ]);

        $editedPage = Page::where('id', $page['page_id'])->first();
        return new PageResource($editedPage);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */


    public function getBookPages(){
        $data = request()->validate([
            'bookId' => 'required',
            'userId' => 'required',
        ]);
        $pages = Page::where('book_id', $data['bookId'])->get();

        return new PageCollection($pages);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */

    public function removeBookImage(Request $request){
        $image_name = $request->imageName;

        $image_path = storage_path('app/public/book-image/' . $image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        return response('done');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */

    public function removeImage(Request $request){
        $image_name = $request->imageName;

        $image_path = storage_path('app/public/book-pages/' . $image_name);
        if(file_exists($image_path)){
            unlink($image_path);
        }
        return response('done');

    }


    public function getBookNotification(){

        $userNotifications = Notification::where('to', Auth()->id())->get();

        return new NotificationCollection($userNotifications);
        // return $userNotifications;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        //
    }
}
