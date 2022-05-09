<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\VilagerController;
use App\Http\Controllers\KtpController;


    Route::post('login', [AuthController::class,'login']);
    Route::post('register', [AuthController::class,'register']);

    Route::group(['middelware'=> 'api'],function(){
        Route::post('logout', [AuthController::class,'logout']);
        Route::post('refresh', [AuthController::class,'refresh']);
        Route::post('me', [AuthController::class,'me']);
        Route::resource('products',ProductController::class);
        Route::resource('vilagers',VilagerController::class);
        Route::resource('services',ServicesController::class);
        Route::resource('ktp',KtpController::class);
    });    


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});