@extends('layouts.app')

@section('content')
<div class="container">

  <h1>Welcome to <strong>InStarkGram</strong></h1>

  @foreach ($posts as $post)
    <div class="row">

      <div class="col-8">
        <img src="{{ $post->image_url }}" alt="" class='w-100'>
      </div>

      <div class="col-4">

        {{-- Post user heading --}}
        <div class="d-flex align-items-center">

          <div class="pr-3">
            {{-- Profile Model method that will give us the User's profile pic OR the default one --}}
            <img src="{{ $post->user->profile->profileImage() }}" alt="" class="w-100 rounded-circle" style="max-width: 40px;">
          </div>
          
          <div>
            <div class="font-weight-bold">
              <a href="/profile/{{ $post->user->id }}">
                <span class="text-dark">{{ $post->user->username }}</span>
              </a>
              <a href="#" class='pl-2'>follow</a>
            </div>
          </div>
          
        </div>

        {{-- Line break --}}
        <hr>

        {{-- Post user caption --}}
        <p>
          <span class="font-weight-bold">
            <a href="/profile/{{ $post->user->id }}">
              <span class="text-dark">{{ $post->user->username }}</span>
            </a>
          </span> {{ $post->caption }}
        </p>
      </div>

    </div>
  @endforeach
</div>
@endsection
