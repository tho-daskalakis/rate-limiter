<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::controller('App\Http\Controllers\UserController')->group(function () {
   // ...other user routes

    Route::patch('/users/{user}', 'update');
});
