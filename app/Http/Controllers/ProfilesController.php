<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfilesController extends Controller
{

    public function index(User $user)
    {
        $profiles = Profile::all();

        // dd($profiles);

        return view('profiles.index', compact('profiles'));
    }

    public function show(User $user)
    {
        // check if authenticated user follows the queried user
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        // ✅ CACHING AVOIDS N+1 PROBLEM (repetitive queries) ✅

        $postCount = Cache::remember(
            'count.posts.' . $user->id, // unique key to remember
            now()->addSeconds(30),      // time that value will stay stored
            function () use ($user) {   // value doesn't already exist? run this.
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });

        return view('profiles.show', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }
    
    public function edit(User $user)
    {
        // checks Profile Policy 'update' function for an auth check, before continuing
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image_url' => ''
        ]);

        // because this is optional it is declared as empty
        $imageArray = [];

        if (request('image_url')) {

            $imagePath = request('image_url')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            // where we then populate the empty associative array;
            $imageArray = ['image_url' => '/storage/' . $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/" . $user->id);

    }
}
