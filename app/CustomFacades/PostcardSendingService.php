<?php

// THIS IS THE IMPLEMENTATION OF THE POSTCARD FACADE...

namespace App\CustomFacades;

use Illuminate\Support\Facades\Mail;

class PostcardSendingService
{

  private $country;
  private $width;
  private $height;

  // construct and initialize with given parameters (c, w, h)
  public function __construct($country, $width, $height)
  {
    $this->country = $country;
    $this->width = $width;
    $this->height = $height;
  }
  

  // function to send message via email
  public function hello($message, $email)
  {
    Mail::raw($message, function ($message) use ($email) {
      $message->to($email);
    });

    // ** Mail out postcard via some service, etc ** 
    
    dump('Postcard was sent with the message: ' . $message);
  }

}