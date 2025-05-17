<?php

use App\Http\Controllers\Person\PersonController;
use App\Http\Controllers\Person\StorePersonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('т people')->name('Person')->group(function () {
    Route::get('/persons', PersonController::class);
    Route::post('/', StorePersonController::class);

});
