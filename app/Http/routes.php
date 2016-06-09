<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/me', 'BotController@me');
Route::get('/setWebhook', 'BotController@setWebhook');
Route::post('/<token>/webhook', function () {
    $update = Telegram::commandsHandler(true);

  // Commands handler method returns an Update object.
  // So you can further process $update object
  // to however you want.

    return 'ok';
});
