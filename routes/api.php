<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\AthleteController;
use App\Http\Controllers\API\Auth\PasswordResetController;



Route::group(["middleware" => ['auth:sanctum']],function(){
    Route::get("/logout", [AuthController::class, 'logout']);

    // Rotas para o AthleteController
        Route::get('/athletes', [AthleteController::class, 'index']); // Listar todos os atletas
        Route::get('/athlete/{athlete_id}', [AthleteController::class, 'show']); // Mostrar um atleta específico
        Route::post('/athlete', [AthleteController::class, 'store']); // Criar um novo atleta
        Route::put('/athlete/{athlete_id}', [AthleteController::class, 'update']); // Editar um atleta existente

});


//Rotas públicas

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'reset'])->middleware('signed')->name('password.reset');
