<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});



Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::resource('posts', PostController::class);
//    Route::get('/posts/search/{title}', [PostController::class, 'search']);
//    Route::get('/post/author/{id}', [PostController::class, 'get_author']);
    Route::get('posts',[PostController::class,'index']);
    Route::get('post/{id}',[PostController::class,'show']);
    Route::post('posts',[PostController::class,'store']);
    Route::post('post/{id}',[PostController::class,'update']);
    Route::post('post/{id}',[PostController::class,'destroy']);
});

Route::post('/auth/register', [AuthController::class, 'createUser']);
Route::post('/auth/login', [AuthController::class, 'loginUser']);

