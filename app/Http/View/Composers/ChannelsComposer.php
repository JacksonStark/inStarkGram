<?php

namespace App\Http\View\Composers;

use App\Channel;
use Illuminate\View\View;


class ChannelsComposer
{
  public function compose(View $view)
  {
    // ordered channels will be passed to certain views in the $channels variable
    $view->with('channels', Channel::orderBy('name', 'desc')->get());
  }
}