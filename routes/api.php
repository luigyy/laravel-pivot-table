<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServicesController;
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


//clients
Route::get('clients', [ClientController::class, 'index']);
Route::post('clients/store', [ClientController::class, 'store']);
Route::post('clients/service/attach', [ClientController::class, 'attachService']);
Route::post('clients/service/detach', [ClientController::class, 'detachService']);

//services
Route::get('services', [ServicesController::class, 'index']);
Route::post('services/store', [ServicesController::class, 'store']);
