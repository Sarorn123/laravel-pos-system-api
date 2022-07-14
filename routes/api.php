<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

///////////////////////////////////////////////
///////////////////////////////////////////////
///////// Laravel API For POS System //////////
///////////////////////////////////////////////
///////////////////////////////////////////////

///////////////////////////////////////////////
///////////@author Ry Sarorn //////////////////
///////////////////////////////////////////////

Route::group(['middleware' => ['apiKey']], function () {
   

    Route::post('user/register', [AuthController::class, 'register']);
    Route::post('user/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        // End Point For Admin
        Route::group(['middleware' => ['admin']], function () {
            
        });

    });
});
