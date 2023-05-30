<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('{id}', 'show');
});
