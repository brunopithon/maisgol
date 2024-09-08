<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\PasswordResetController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'reset'])->middleware('signed')->name('password.reset');

Route::group(["middleware" => ['auth:sanctum']],function(){    
    Route::get('/teste', function () {
        return 'Rota funcionando!';
    });

    Route::get("/logout", [AuthController::class, 'logout']);
});