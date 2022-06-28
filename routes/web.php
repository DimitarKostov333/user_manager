<?php

// UsersController will handle visitors that are verified by email
Route::get('/', 'UsersController@index')->middleware('verified');

// All input requests to the controller will be filtered through
// a XSS sanitizer to ensure users cannot enter code
Route::group(['middleware' => ['XssSanitizer']], function () {

    // Resource route to handle CRUD requests with the exception of index method.
    Route::resource('/users', 'UsersController', ['except' => 'index']);

});

Auth::routes(['verify' => true]);
