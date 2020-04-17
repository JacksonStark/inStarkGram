<?php

namespace App;

use App\Post;
use App\Video;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $guarded = [];

    // rather than having 2 models (PostTag and VideoTag)
    // we make the Tag Model be flexible to belong to MANY posts and MANY videos

    public function posts()
    {
        // a Tag can have MANY Posts that it belongs to
        return $this->morphByMany(Post::class, 'taggable');
    }
    
    public function videos()
    {
        // a Tag can have MANY Videos that it belongs to
        return $this->morphByMany(Video::class, 'taggable');
    }
}
