<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\DevProfileController;
use App\Http\Controllers\Api\FieldController;
use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Api\ReviewController;


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

// index profili
Route::get('/profiles', [DevProfileController::class, 'index']);
// show profilo
Route::get('/profiles/{slug}', [DevProfileController::class, 'show']);


Route::post('/contacts', [LeadController::class, 'store']);

Route::get('/fields', [FieldController::class, 'index']);

Route::get('/reviews', [ReviewController::class, 'index']);

Route::post('/reviews/store', [ReviewController::class, 'store']);