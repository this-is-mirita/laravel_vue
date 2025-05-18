<?php

use App\Http\Controllers\Person\IndexController;
use App\Http\Controllers\Person\StorePersonController;
use App\Http\Controllers\Person\UpdatePersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('people')->name('Person')->group(function () {
    Route::post('/', StorePersonController::class);

    //api/people/persons
    Route::get('/persons', IndexController::class);

    //api/people/persons/
    Route::patch('/persons/{person}', UpdatePersonController::class);

});
