<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DrawTypeController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\DrawController;

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



Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::prefix('/ticket')->group(function () {
        Route::post('/create', [TicketController::class, 'createTicket']);
    });
});
