<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'api', 'prefix' => 'auth'], function () {
    Route::post('register', [AuthController::class, 'register']);
	Route::post('login', [AuthController::class, 'login']);
	Route::post('logout', [AuthController::class, 'logout']);
	Route::post('refresh', [AuthController::class, 'refresh']);
	Route::post('me', [AuthController::class, 'me']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('posts', PostController::class)->middleware('jwt.auth');

Route::get('posts', [PostController::class, 'index']);
Route::post('posts', [PostController::class, 'store'])->middleware('jwt.auth');
Route::get('posts/{post}', [PostController::class, 'show']);
Route::put('posts/{post}', [PostController::class, 'update'])->middleware('jwt.auth');
Route::delete('posts/{post}', [PostController::class, 'destroy'])->middleware('jwt.auth');
