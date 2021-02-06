<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Friend;
use App\Message;
use App\Events\NewMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    public function get(){
        $totalUnread = Message::where('to', auth()->id())->where('read', false)->get();
        $totalCount = count($totalUnread);
        // get all users except the authintaced one
        $friends = Friend::friendships();
        $contacts = User::whereIn('id', $friends->pluck('user_id'))->orWhereIn('id', $friends->pluck('friend_id'))->where('id', '!=', auth()->id())->get();
        //above query $contacts is getting all the friends that has accepted the friend request
        $unreadIds = Message::select(DB::raw('`from` as sender_id, count(`from`) as messages_count')) //step 3
            ->where('to', auth()->id()) //step 1
            ->where('read', false)
            ->groupBy('from')->get(); //[ ['sender_id' => 4, 'messages_count' => 15] ] step 2
            //

        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $contact;
        });
        return response()->json($contacts);
    }


    public function getMessagesFor($message_id){
        // $messages = Message::where('from', $message_id)->orWhere('to', $message_id)->get();
        // mark all the messages with the selected contact as read
        Message::where('from', $message_id)->where('to', auth()->id())->update([
            'read' => true,
        ]);

        // $messages = Message::where(function($q) use ($message_id){
        //     $q->where('from', auth()->id());
        //     $q->where('to', $message_id);
        // })->orWhere(function($q) use ($message_id){
        //     $q->where('to', auth()->id());
        //     $q->where('from', $message_id);
        // })->get(); //(a = 1 AND b = 2) or (a = 2 AND b = 1)
        $messages = Message::where(function ($q) use ($message_id){
            $q->where('from', auth()->id());
            $q->where('to', $message_id);
        })->orWhere(function ($q) use ($message_id){
            $q->where('from', $message_id);
            $q->where('to', auth()->id());
        })->get();
        return response()->json($messages);
    }


    public function sendMessage(Request $request){
        $message = Message::create([
            'from' => auth()->id(),
            'to' => $request->contact_id,
            'text' => $request->text,
        ]);

        broadcast(new NewMessage($message));
        return response()->json($message);
    }



    public function totalUnread(){
        $unreadContact = Message::where('to', auth()->id())->where('read', false)->get();
        $unreadCount = count($unreadContact);
        return response()->json($unreadCount);
    }
}
