<?php

// THIS IS THE POSTCARD FACADE... a facade is a --->

// class that provides a STATIC-like interface to more complex services inside the container

// facades serve as a PROXY for accessing the underlying implementation of container services

namespace App\CustomFacades;

// use Illuminate\Support\Facades\Mail;

class Postcard
{

  // where facade will get implemented
  protected static function resolveFacade($name)
  {
    // calls app()['Postcard'] --> check AppServiceProvider->boot() for info
    return app()[$name];
  }

  // If a static method is called that does NOT exist --> Postcard::hello()
  // it will trickle down into the magic __callStatic() method
  public static function __callStatic($method, $arguments)
  {

    // Because we are on the class and not an instance we must use a
    // static perspective --> self::
    return (self::resolveFacade('Postcard'))
      ->$method(...$arguments);
    // we can dynamically call the $method and spread the $arguments
  }
}
