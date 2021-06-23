<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\Book as myBookResource;

class MyBookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function __construct(){
    //     $this->middleware("auth:api");
    // }

    public function index()
    {
        return view('books/mybook');
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


        $myBook = request()->user()->myBooks()->create([
            'book_name' => $data['bookName'],
            'book_page' => $data['bookPage'],
            'book_unique_name' => $data['bookUniqueName'],
            'book_title_image' => $data['bookTitleImage'],
            'book_tags' => $data['bookTagsName'],
        ]);

        return new myBookResource($myBook);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\myBook  $myBook
     * @return \Illuminate\Http\Response
     */
    public function show(Book $myBook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\myBook  $myBook
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $myBook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\myBook  $myBook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\myBook  $myBook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $myBook)
    {
        //
    }
}
