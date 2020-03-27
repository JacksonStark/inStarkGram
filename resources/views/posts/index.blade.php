@extends('layouts.app')

@section('content')
<div class="container">

  <hr>
  <h1>Welcome to <strong style="fontStyle: italic;">InStarkGram</strong></h1>
  <hr>
  <hr>

  @foreach ($posts as $post)
    <div class="row">

      <div class="col-6 offset-3">
        <a href="/profile/{{ $post->user->id }}"><img src="{{ $post->image_url }}" alt="" class='w-100'></a>
      </div>
    </div>

    <div class="row pt-2 pb-4">

      <div class="col-6 offset-3">
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

  <div class="row">
    <div class="col-12 d-flex justify-content-center">

      {{-- links() becomes a property of to $posts when we paginate --}}
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection
