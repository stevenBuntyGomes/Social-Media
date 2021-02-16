<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Resources\User as UserResource;


class AuthUserController extends Controller
{
    public function show(){
        return new UserResource(auth()->user());
    }


    // public function logout(Request $request){
    //     Auth::logout();
    //     return redirect('/login');
    // }


    public function updateName(){
        $data = request()->validate([
           'updateUserName' => 'required',
        ]);

        $authUser = User::where('id', Auth()->id())->first();

        if($data['updateUserName'] == $authUser->name){
            $status = 1;
            return response()->json($status);
        }else{
            User::where('id', Auth()->id())->update([
                'name' => $data['updateUserName'],
            ]);
            return new UserResource(auth()->user());
        };



    }

    public function updatePassword(){
        $data =request()->validate([
            'oldPassword' => 'required',
            'password' => 'required',
            'confirmPassword' => 'required',
        ]);

        $user = User::where('id', Auth()->id())->first();
        if(Hash::check($data['oldPassword'], $user->password)){
            if($data['oldPassword'] == $data['password']){
                $status = 2;
                return response()->json($status);
            }else{
                if($data['password'] != $data['confirmPassword']){
                    $status = 3;
                return response()->json($status);
                }else{
                    User::where('id', Auth()->id())->update([
                        'password' => Hash::make($data['password']),
                    ]);
                    $status = 4;
                    return response()->json($status);
                }
            }
        }else{
            $status = 1;
            return response()->json($status);
        }
    }
}
