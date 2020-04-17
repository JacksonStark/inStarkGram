<?php

namespace App;

use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // When new user is registered, we hook up a default profile for them on CREATION of the User Model
    protected static function boot()
    {
        // boot gets called when this model is booted up
        parent::boot();
        // created event gets fired whenever a new user gets created
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username
            ]);

            // Mail to the newly registered user's email a new instance of the NewUserWelcomeMail class.
            Mail::to($user->email)->send(new NewUserWelcomeMail());
        });



    }

    // ACCESS RELATIONS...

    public function profile() 
    {
        // dont need to import Profile since already in App namespace
        return $this->hasOne(Profile::class);
    }

    public function following()
    {
        // a User can have MANY Profiles that it follows (following)
        return $this->belongsToMany(Profile::class);
    }


    public function posts()
    {
        // dont need to import Post since already in App namespace
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function image()
    {
        // Grab IMAGE related to this POST
        return $this->morphOne(Image::class, 'imageable');
    }
}
