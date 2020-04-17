<?php

namespace App;

use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{

    protected $guarded = [];

    public function comments()
    {
        // a Video can have MANY Comments on it
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    public function tags()
    {
        
        // a Video can have MANY Tags
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
