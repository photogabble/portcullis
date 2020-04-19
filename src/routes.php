<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| ...
|
*/
Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Registration Queue Routes
|--------------------------------------------------------------------------
|
| ...
|
*/
if (registration()->hasQueue()) {
    Route::view('/register/queue', 'auth.queue')->name('register.queue');
    Route::post('/register/queue', 'Auth\QueueController@store')->name('register.queue.submit');
}

