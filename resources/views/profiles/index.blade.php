@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img style="width: 120px" class="rounded-circle" src="https://instagram.fyvr4-1.fna.fbcdn.net/v/t51.2885-19/s320x320/87715854_193913831699544_8044649418160340992_n.jpg?_nc_ht=instagram.fyvr4-1.fna.fbcdn.net&_nc_ohc=lnUOSKorH0gAX-X6C5N&oh=7e11dbaceb51ae89853e03c0c65c59bc&oe=5E8ACCDA">
        </div>
        <div class='col-9 pt-5'>
            <div class='d-flex justify-content-between align-items-baseline'>
                <header><h1>{{ $user->username }}</h1></header>
                <a href="/p/create">Add New Post</a>
            </div>
            <section class='d-flex'>
                <div class="pr-4"><strong>{{ $user->posts->count() }}</strong> posts</div>
                <div class="pr-4"><strong>23k</strong> followers</div>
                <div class="pr-4"><strong>212</strong> following</div>
            </section>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-4">
        @foreach ($user->posts as $post)    
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src={{ $post->image_url }} alt="" class="w-100">
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
