<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function() {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('/posts', 'PostController@store');
    // like
    Route::post('/posts/{post}/like', 'PostLikeController@store');
    // like
    // comment
    Route::post('/posts/{post}/comment', 'PostCommentController@store');
    // comment
    Route::get('/get_posts', 'PostController@index');
    Route::get('/users/{user_id}', 'UserController@show');
    Route::get('users/{user_id}/posts', 'UserPostController@index');
    Route::post('/friend-request', 'FriendRequest@store');
    // Route::post('/friend-request-response', 'FriendRequestResponseController@store');
    // Route::post('/friend-request-response/delete', 'FriendRequestResponseController@destroy');
    Route::Resource('/friend-request-response', 'FriendRequestResponseController');
    Route::post('/friend-request-response/delete', 'FriendRequestResponseController@destroy');

    // user image controller

    Route::Resource('/user-images', 'UserImageController');

    // user image controller


    Route::get('/auth-user', 'AuthUserController@show');
    // Route::get();

    // Route::apiResources([
    //     'users', 'UserController',
    // ]);
});
