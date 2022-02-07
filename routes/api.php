<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SpaceshipController;
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

Route::post('login',[LoginController::class,'authenticate']);

Route::get('/spaceships',[SpaceshipController::class,'index']);
Route::get('/spaceships/{id}',[SpaceshipController::class,'show']);
Route::post('/spaceships',[SpaceshipController::class,'store']);
Route::patch('/spaceships/{id}',[SpaceshipController::class,'update']);
Route::delete('/spaceships/{id}',[SpaceshipController::class,'destroy']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
