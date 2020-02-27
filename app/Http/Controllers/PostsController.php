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

    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show', ['post' => $post]);
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
        // after saving, any time the image file path is called it will pass through img intervention.
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image_url' => '/storage/' . $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);

    }
}
