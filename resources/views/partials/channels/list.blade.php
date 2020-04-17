<ul>
  @foreach ($channels as $channel)
        <li><h5>{{ $channel->name }}</h5></li>
  @endforeach
</ul>