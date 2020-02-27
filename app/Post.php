<?php

namespace App;

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
}
