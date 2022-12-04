<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('save_image',[\App\Http\Controllers\CrudController::class,'saveImage']);
Route::get('fetch_image',[\App\Http\Controllers\CrudController::class,'fetchImage']);
Route::patch('edit_image/{id}',[\App\Http\Controllers\CrudController::class,'editImage']);
Route::post('update_image/{id}',[\App\Http\Controllers\CrudController::class,'updateImage']);
Route::get('delete_image/{id}',[\App\Http\Controllers\CrudController::class,'deleteImage']);
