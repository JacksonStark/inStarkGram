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
        // dd($user);
        return view('profiles.edit', compact('user'));
    }

    public function update()
    {
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            // 'image_url' => ['required', 'image'],
            'image_url' => ''
        ]);

        // $imagePath = request('image_url')->store('uploads', 'public');

        // $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        // $image->save();

        // dd($data);

        auth()->user()->profile->update(
            $data
            // 'title' => $data['title'],
            // 'description' => $data['description'],
            // 'url' => $data['url'],
            // 'image_url' => '/storage/' . $imagePath,
        );

        return redirect("/profile/" . $user->id);

    }
}
