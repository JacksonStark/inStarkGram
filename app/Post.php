<?php

namespace App;

use App\Tag;
use App\Image;
use App\Comment;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $guarded = [];

    // ACCESS RELATION
    public function user() 
    {
        // dont need to import User since already in App namespace
        return $this->belongsTo(User::class);
    }

    // Grab IMAGE related to this POST
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
    
    // POLYMORPHIC many-to-many relationship --> intermediary table is 'taggable'
    public function tags()
    {
        // A Post can have MANY Tags
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
