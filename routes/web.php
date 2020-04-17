<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use App\CustomFacades\Postcard;
use App\Mail\NewUserWelcomeMail;

Auth::routes();


Route::get('email', function () {
  return new NewUserWelcomeMail();
});

// ADVANCED LARAVEL TUTORIAL ROUTES...

Route::get('pay', 'PayOrderController@store');

Route::get('channel', 'ChannelController@index');

Route::get('submissions/create', 'SubmissionController@create');

Route::get('/facades', function() {
  // Calling static method on Postcard Class 
  // (Proxy, or facade for PostcardSendingService implementation)
  Postcard::hello('message to be emailed out', 'jacksonstark77@hotmail.com');
});

// POST ROUTES...

Route::get('/', 'PostsController@index');

Route::get('/p/create', 'PostsController@create');

Route::get('/p/{post}', 'PostsController@show');

Route::post('/p', 'PostsController@store');

Route::post('/follow/{user}', 'FollowsController@store');


// PROFILE ROUTES...

Route::get('/discover', 'ProfilesController@index');

Route::get('/profile/{user}', 'ProfilesController@show')->name('profile.show');

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit');

Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update');


