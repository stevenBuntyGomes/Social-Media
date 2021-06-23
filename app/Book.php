<?php

namespace App;
use App\Scopes\ReverseScope;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];

    protected static function boot(){
        parent::boot();

        static::addGlobalScope(new ReverseScope());
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function page(){
        return $this->hasMany(Page::class);
    }


    // loveBook starts

    public function loveBook(){
        return $this->belongsToMany(User::class, 'love_books', 'book_id', 'user_id');
    }

    // loveBook ends
    // bookComment part starts
    public function book_comments(){
        return $this->hasMany(BookComment::class);
    }

    // bookComment part ends

}
