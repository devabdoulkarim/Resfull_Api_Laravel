<?php

use App\Http\Controllers\Api\SclassController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\SubjectController;
use App\Http\Controllers\Api\V1\PersonController as V1PersonController;
use App\Http\Controllers\Api\V2\PersonController;
use App\Http\Controllers\AuthController;
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

Route::prefix('v1')->group(function(){
    Route::apiResource('/person', V1PersonController::class)->only(['show','destroy','store','update']);
    Route::apiResource('/people', V1PersonController::class)->only('index');
});

Route::prefix('v2')->group(function(){
    Route::apiResource('/person', PersonController::class)->only('show');
});

Route::apiResource('class', SclassController::class);
Route::apiResource('/subject', SubjectController::class);
Route::apiResource('/student', StudentController::class);

Route::group([

    'prefix' => 'auth'

], function () {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class,'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me',[AuthController::class, 'me']);
    Route::post('register',[AuthController::class, 'register']);

});
