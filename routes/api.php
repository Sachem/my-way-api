<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\HabitController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function(){
    
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('habits', HabitController::class);
    Route::get('/habit/categories', [HabitController::class, 'categories']);
        
});

Route::get('/', function (Request $request) {
    return response()->json('Hello, you requested "My Way" API\'s root path. Nothing here, but glad to see you :)', 200);
});

Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback']);
