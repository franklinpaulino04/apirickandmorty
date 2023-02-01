<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// login
Route::post('/login', [AuthController::class, 'login']);

// public character routes
Route::get('/character', [CharacterController::class, 'index']);
Route::get('/character/{character}', [CharacterController::class, 'show'])->name('character.show');

// public episode routes
Route::get('/episode', [EpisodeController::class, 'index']);
Route::get('/episode/{episode}', [EpisodeController::class, 'show'])->name('episode.show');

// public character routes
Route::get('/location', [LocationController::class, 'index']);
Route::get('/location/{location}', [LocationController::class, 'show'])->name('location.show');

Route::group(['middleware' => ['auth:sanctum']], function () {

    // private user routes
    Route::get('/user', [AuthController::class, 'show']);

    // private character routes
    Route::post('/character', [CharacterController::class, 'store']);
    Route::put('/character/{character}', [CharacterController::class, 'update']);
    Route::delete('/character/{character}', [CharacterController::class, 'destroy']);

    // private location routes
    Route::post('/location', [LocationController::class, 'store']);
    Route::put('/location/{location}', [LocationController::class, 'update']);
    Route::delete('/location/{location}', [LocationController::class, 'destroy']);

    // private episode routes
    Route::post('/episode', [EpisodeController::class, 'store']);
    Route::put('/episode/{episode}', [EpisodeController::class, 'update']);
    Route::delete('/episode/{episode}', [EpisodeController::class, 'destroy']);

    // logout
    Route::post('/logout', [AuthController::class, 'logout']);
});
