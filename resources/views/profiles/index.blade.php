@extends('layouts.app')

@section('content')
<div class="container">

  <hr>
  <div class="d-flex justify-content-center">
    <h1>Discover <strong style="fontStyle: italic;">InStarkGram</strong> Users</h1>
  </div>
  <hr>


  <div class="d-flex justify-content-center flex-wrap">
    @foreach ($profiles as $profile)
      <div class="row d-flex flex-column align-items-center p-5">
        <div>
          <a href="/profile/{{ $profile->user_id }}">
            <img src="{{ $profile->profileImage() }}" alt="" class="rounded-circle" style="height: 150px;">
          </a>
        </div>
        
        <div class="pt-3">
          <a href="/profile/{{ $profile->user_id }}">
            {{-- <img src="{{ $post->image_url }}" alt="" class='w-100'> --}}
            <h3>{{ $profile->title }}</h3>
          </a>
        </div>
  
      </div>
    @endforeach
  </div>

  <div class="row">
    <div class="col-12 d-flex justify-content-center">

      {{-- links() becomes a property of to $posts when we paginate --}}
      {{-- {{ $posts->links() }} --}}
    </div>
  </div>
</div>
@endsection
