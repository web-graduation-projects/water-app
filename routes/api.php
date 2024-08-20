<?php

use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/users', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/user', [UserController::class, 'store']);

Route::post('/test', function (Request $request) {
    dd($request->all());
});
