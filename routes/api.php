<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrawTypeController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\DrawController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PayAccountController;

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

Route::get('/draw_types', [DrawTypeController::class, 'listAll']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:sanctum'], function() {

    Route::group(['prefix' => 'profile'], function() {
        Route::get('/', [UserController::class, 'profile']);

        Route::get('/payaccountinfo', [PayAccountController::class, 'payAccountInfo']);

        Route::get('/payhistory', [UserController::class, 'payHistory']);

        Route::get('/mytickets', [TicketController::class, 'mytickets']);
    });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::get('/checktoken', [AuthController::class, 'checkAuthToken']);

    Route::prefix('/ticket')->group(function () {
        Route::post('/create', [TicketController::class, 'createTicket']);

    });
});

