<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $guarded = [];

    // protected $fillable = [ 
        // 'title', 'description', 'url'
    // ];

    // ACCESS RELATION
    public function user()
    {
        // dont need to import User since already in App namespace
        return $this->belongsTo(User::class);
    }
}
