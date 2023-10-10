<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RestaurantApiController;
use App\Http\Controllers\RestaurantLanguageApiController;
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

Route::get('/restaurants/restaurant/{id}', [RestaurantApiController::class, "getRestaurantById"]);

Route::get("/restaurants/list", [RestaurantApiController::class, "list"]);

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

Route::middleware("auth:api")->group(function() {
    Route::get('/restaurants', [RestaurantApiController::class, "all"]);
    Route::post('/restaurants', [RestaurantApiController::class, "addRestaurant"]);
    Route::put('/restaurants/{id}', [RestaurantApiController::class, "updateRestaurant"]);
    Route::delete('/restaurants/{id}', [RestaurantApiController::class, "deleteRestaurant"]);

    Route::post('/descriptions', [RestaurantLanguageApiController::class, "addRestaurantLanguage"]);
    Route::put('/descriptions/{id}', [RestaurantLanguageApiController::class, "updateRestaurantLanguage"]);
});
