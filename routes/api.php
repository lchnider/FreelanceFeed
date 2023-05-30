<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\UserController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->controller(UserController::class)->group(function () {
    // Route::get('/', 'index');
    Route::get('{id}', 'show');
});

// Route::resource('skills', SkillController::class);
// Route::resource('works', WorkController::class);
// Route::resource('posts', PostController::class);
