<?php
/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| ...
|
*/
Auth::routes(['verify' => true, 'register' => registration()->isOpen()]);

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

