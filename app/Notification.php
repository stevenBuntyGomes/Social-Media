<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function fromUser(){
        return $this->belongsTo(User::class, 'from');
    }

    public function toUser(){
        return $this->belongsTo(User::class, 'to');
    }


    public function book(){
        return $this->belongsTo(Book::class);
    }


    public function post(){
        return $this->belongsTo(Post::class);
    }

}
