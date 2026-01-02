<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;



Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function (){
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);
    });
   
});