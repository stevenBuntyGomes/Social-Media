<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];


    public function user(){
        $this->belongsTo(User::class);
    }

    public function pageOfBook(){
        $this->belongsTo(Book::class);
    }


}
