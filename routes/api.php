<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Developer\DeveloperController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Supplier\SupplierContoller;
use App\Http\Controllers\Transaction\TransactionController;
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

    Route::group(['prefix' => 'developer'], function () {
        Route::post('/add-role', [DeveloperController::class, 'addRole']);
        Route::post('/add-permission', [DeveloperController::class, 'addPermission']);
        Route::post('/assign-permission-to-role', [DeveloperController::class, 'assignPermissionToRole']);
    });

    ///// Authentication /////
    Route::post('user/register', [EmployeeController::class, 'store']);
    Route::post('user/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::get('get-user-login-by-token', [AuthController::class, 'getUserLoginByToken']);

        // End Point For Admin
        Route::group(['prefix' => 'admin', 'middleware' => ['admin']], function () {

            Route::resource('/product', ProductController::class);
            Route::resource('/customer', CustomerController::class);
            Route::resource('/employee', EmployeeController::class);
            Route::resource('/transaction', TransactionController::class);
            Route::resource('/supplier', SupplierContoller::class);

        });
    });
});

// YA lyublyu tebya i love you


// posgress online view : https://pgweb-demo.herokuapp.com/