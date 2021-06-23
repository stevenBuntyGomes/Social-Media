<?php

use Illuminate\Support\Facades\Broadcast;
use App\Message;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/
// message channel starts
// message channel ends
Broadcast::channel('messages.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return $user->id === (int) $id;
});
// message channel ends

// friend request channel starts
Broadcast::channel('friendRequests.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});
// friend request channel ends


// friend request channel accept starts

Broadcast::channel('acceptFriendRequest.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});

// friend request channel accept ends

// post Notification channel accept starts

Broadcast::channel('postNotifications.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});

// post Notification channel accept ends


// post Comment Notification channel accept starts

Broadcast::channel('postCommentNotifications.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});

// post Comment Notification channel accept ends


// post Like Notification channel accept starts

Broadcast::channel('postLikeNotifications.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});

// post Like Notification channel accept ends


// NewBookNotification channel accept starts
Broadcast::channel('NewBookNotification.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});
// NewBookNotification channel accept ends

// LoveBook notification channel starts

Broadcast::channel('bookLoveNotification.{id}', function ($user, $id) {
    // dd($user->id, $id);
    return (int) $user->id === (int) $id; //when the auth user = $user id will be equal to
    // $id that has been sent through {id} will make the event occure.
});

// LoveBook notification channel ends

// book comment notification starts

Broadcast::channel('BookCommentNotification.{id}', function ($user, $id){
    return (int) $user->id === (int) $id;
});

// book comment notification ends
