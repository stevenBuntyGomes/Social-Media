<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    public function show($id){
        $user = User::where('id', $id)->first();
        return new UserResource($user);
        // return response()->json('fuck');
    }
}
