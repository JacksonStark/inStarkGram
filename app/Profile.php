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

    // Profile Model method that returns a default profile photo if usewr has not set one
    public function profileImage()
    {
        return $this->image_url ? $this->image_url : '/storage/profile/EhElpmjSrCXYfGTYwK225N7XC9NbRYQwm19ivwTe.png';
    }
}
