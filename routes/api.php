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
    Route::post('/posts/edit', 'PostController@update');
    Route::post('/posts/destroy/', 'PostController@deletePost');
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
    Route::post('/friend-request-response/unfriend', 'FriendRequestResponseController@unfriend');
    Route::post('/auth/about', 'AboutController@index');
    Route::post('/auth/about/edit', 'AboutController@update');

    // user image controller

    Route::Resource('/user-images', 'UserImageController');

    // user image controller


    Route::get('/auth-user', 'AuthUserController@show');
    Route::post('/user/authFriends', 'AuthUserController@getFriends');
    Route::post('/auth-user/nameUpdate', 'AuthUserController@updateName');
    Route::post('/auth-user/passwordUpdate', 'AuthUserController@updatePassword');
    // Route::post('/auth-logout', 'AuthUserController@logout');
    // Route::get();

    // Route::apiResources([
        //     'users', 'UserController',
        // ]);

    // search part starts

    Route::post('/search/userSearch', 'SearchController@userSearch');

    // search part ends


    // contact message route starts

    Route::get('/contacts', 'ContactsController@get');
    Route::get('/conversation/{message_id}', 'ContactsController@getMessagesFor');
    Route::post('/conversation/send', 'ContactsController@sendMessage');
    Route::get('/countChatContacts', 'ContactsController@totalUnread');

    // contact message route ends


    // mybook part starts


    Route::post('/auth/book', 'BookController@getUserBooks');
    Route::post('/get_books', 'BookController@bookFeed');
    Route::post('/mybook/createMyBook', 'BookController@createBook');
    // Route::post('/book/createMyBook', 'BookController@createBook');
    Route::post('/mybook/storePages', 'BookController@storePages');
    Route::post('/book/addImage', 'BookController@addImage');
    Route::post('/mybook/addPageDB', 'BookController@addPageDB');
    Route::post('/mybook/editPageDB', 'BookController@editPageDB');
    Route::post('/book/removeImage', 'BookController@removeImage');
    Route::post('/book/removeBookImage', 'BookController@removeBookImage');
    // bookLove part starts
    route::post('/book/{book_id}/loveBook', 'LoveBookController@store');
    // bookLove part ends
    // bookComments starts
    route::post('/book/{book_id}/comment', 'BookCommentController@store');
    // bookComments ends
    // mybook part ends
    route::post('/book/editBookDB', 'BookController@editBookToDB');
    route::post('/book/getBookPages', 'BookController@getBookPages');

    // get Notification starts
    route::post('/mybook/getNotifications', 'NotificationController@index');
    route::post('/book/deleteNotification', 'NotificationController@DeleteNotification');
    // get Notification ends
});
Route::get('mybook/pages/{book_id}', 'BookController@index');
