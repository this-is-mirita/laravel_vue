<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
// https://techvblogs.com/blog/how-to-install-vue-3-in-laravel-9-with-vite
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
