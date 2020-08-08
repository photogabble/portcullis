<?php

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| ...
|
*/
Auth::routes(['verify' => true]);

Route::view('/register/password-confirm', 'auth.password-confirm')->name('register.password-confirm');
Route::post('/register/password-confirm', 'Auth\RegisterController@passwordConfirm')->name('register.password-confirm.submit');

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

