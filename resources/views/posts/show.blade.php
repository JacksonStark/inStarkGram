@extends('layouts.app')

@section('content')
<div class="container">
  <img src="{{ $post->image_url }}" alt="" class='w-50'>
  <h1>{{ $post->caption }}</h1>
</div>
@endsection
