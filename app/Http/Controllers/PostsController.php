<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;


class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        // 'another field that needs no validation' => '',     ## set to an empty string to pass thru.
        $data = request()->validate([
            'caption' => 'required',
            'image_url' => ['required','image'],
        ]);

        $imagePath = request('image_url')->store('uploads', 'public');

        // takes image, wraps it around intervention class, then fits it to dimensions
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        // after saving, any time the image file path is called it will pass through img intervention.


        // create new post directly through current user's POST relationship
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image_url' => '/storage/' . $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    // model binding, \App\Post, allows shorthand for Post::findOrFail($id)
    public function show(\App\Post $post)
    {
        // compact is a shorthand equivalent of ['post' => $post]
        return view('posts.show', compact('post'));
    }
}
