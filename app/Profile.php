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
        // return $this->image_url ? $this->image_url : '/storage/profile/EhElpmjSrCXYfGTYwK225N7XC9NbRYQwm19ivwTe.png';
        return $this->image_url ? $this->image_url : 'https://lh3.googleusercontent.com/proxy/uSu7K-uPmvPXJJohd4IePeuNpjzhgSLZZXhQdL8SXITbIMeUw-j7CG5G4b8cWvl5ak3oRu9Wxjbt2fZVCLc-2SynrjVN0F4lhIzNuqHlv3PMMcDgh4CjQNQH08tUSozTX-_i';
    }

    public function followers()
    {
        // a Profile can have MANY Users that follow it (followers)
        return $this->belongsToMany(User::class);
    }
}
