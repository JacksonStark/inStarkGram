<?php

namespace App\Http\Controllers;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
        return view('profiles.index', compact('user'));
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
            // 'image_url' => ['required', 'image'],
            'image_url' => ''
        ]);

        $imagePath = '';

        if (request('image_url')) {
            $imagePath = request('image_url')->store('profile', 'public');
    
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();
        }

        auth()->user()->profile->update(array_merge(
            $data,
            ['image_url' => '/storage/' . $imagePath]
        ));

        return redirect("/profile/" . $user->id);

    }
}
