@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            {{-- Call to the the profileImage method on the Profile model --}}
            <img style="width: 120px" class="rounded-circle" src="{{ $user->profile->profileImage() }}">
        </div>
        <div class='col-9 pt-5'>
            <div class='d-flex justify-content-between align-items-baseline'>
                <div class='d-flex align-items-center'>
                    <h1>{{ $user->username }}</h1>
                    @can('follow', $user->profile)
                    <div class='h3'>
                        <follow-button></follow-button>
                    </div>
                    @endcan
                </div>
                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan

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
