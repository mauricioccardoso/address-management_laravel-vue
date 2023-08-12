<?php

use App\Http\Controllers\AddressController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(AddressController::class)->group(function () {
    Route::get("/addresses", 'listAll');
    Route::post("/addresses", 'store');
    Route::put("/addresses/{address}", 'update');
    Route::delete("/addresses/{address}", 'destroy');
});
