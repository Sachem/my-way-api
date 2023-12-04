<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\HabitController;
use App\Http\Controllers\HabitProgressController;

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
    Route::get('/habit/meta', [HabitController::class, 'meta']);

    Route::post('/habit/mark-completed/{habit}', [HabitProgressController::class, 'markCompleted']);
    Route::post('/habit/change-progress/{habit}', [HabitProgressController::class, 'changeProgress']);
    Route::get('/habit/load-progress/{habit}', [HabitProgressController::class, 'loadProgress']);
    
});



Route::get('/', function (Request $request) {
    return response()->json('Hello, you requested "My Way" API\'s root path. Nothing here, but glad to see you :)', 200);
});

Route::get('auth/socialite/{provider}', [SocialiteController::class, 'redirectToProvider']);
Route::get('auth/socialite/{provider}/callback/{accessToken?}', [SocialiteController::class, 'handleProviderCallback']);
