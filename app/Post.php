<?php

namespace App;

use App\Scopes\ReverseScope;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];


    protected static function boot(){
        parent::boot();

        static::addGlobalScope(new ReverseScope());
    }

    public function User(){
        return $this->belongsTo(User::class);
    }



    public function likes(){
        return $this->belongsToMany(User::class, 'likes', 'post_id', 'user_id');
        // first User::class means post belongs to many User. second 'likes' is pivot table
        //that connects User and Post model or tables. It has 'post_id' it means where the
        //like belongs to and 'user_id' which is the related key that connects post and Like
        //model or table. post_od is connected to Post model's id column
        //this simply means which post column should connect with which user through like
        // table
    }


    // relationship with comment
    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
