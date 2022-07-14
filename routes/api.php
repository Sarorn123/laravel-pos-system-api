<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Developer\DeveloperController;
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


    Route::post('developer/add-role', [DeveloperController::class, 'addRole']);
    Route::post('developer/add-permission', [DeveloperController::class, 'addPermission']);
    Route::post('developer/assign-permission-to-role', [DeveloperController::class, 'assignPermissionToRole']);


    Route::post('user/register', [AuthController::class, 'register']);
    Route::post('user/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        // End Point For Admin
        Route::group(['middleware' => ['admin']], function () {
            
        });

    });
});
