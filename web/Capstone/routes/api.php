<?php

use App\Http\Controllers\ArduinoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OpenApiController;
use App\Http\Resources\ArduinoResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('arduino')->group(function() {
    Route::post('/login', [ArduinoController::class, 'login']);
    Route::post('/serial', [ArduinoController::class, 'serialRegist']);
});
Route::prefix('User/{userID}/arduino')->group(function (){
    Route::post('/input', [ArduinoController::class, 'sensorInput']);
    Route::post('/logout', [ArduinoController::class, 'ArduinoLogout']);
    Route::post('/refresh', [ArduinoController::class, 'refresh']);
});

Route::get('/apiToJson', [OpenApiController::class, 'getAPI']);

Route::get('/apiTest', function(){
    return response()->json(['success'=>'1'], 201);
});