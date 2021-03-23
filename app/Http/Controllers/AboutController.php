<?php

namespace App\Http\Controllers;

use App\About;
use Illuminate\Http\Request;
use App\Http\Resources\About as AboutResource;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = request()->validate([
            'user_id' => 'required|numeric',
        ]);

        $about = About::where('user_id', $data['user_id'])->first();

        return new AboutResource($about);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function show(About $about)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $data = request()->validate([
            'study_place' => '',
            'work_place' => '',
            'business' => '',
            'Location' => '',
            'contact' => '',
        ]);

        About::where('id', Auth()->id())->update([
            'study_place' => $data['study_place'] ?? null,
            'work_place' => $data['work_place'] ?? null,
            'business' => $data['business'] ?? null,
            'Location' => $data['Location'] ?? null,
            'contact' => $data['contact'] ?? null,
        ]);

        $about = About::where('id', Auth()->id())->first();
        return new AboutResource($about); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        //
    }
}
