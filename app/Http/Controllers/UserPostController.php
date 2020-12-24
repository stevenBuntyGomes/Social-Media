<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\PostCollection as Postcollection;
use App\Http\Resources\User as UserResource;

class UserPostController extends Controller
{
    public function index($id){
        $user = User::where('id', $id)->first();
        return new Postcollection($user->posts);
    }
}