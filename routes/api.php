<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/', function(){
    return response()->json(['message' => 'API has run']);
});

Route::apiResource('user', \App\Http\Controllers\API\UserController::class);
