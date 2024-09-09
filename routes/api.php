<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\AthleteController;
use App\Http\Controllers\API\CoachController;
use App\Http\Controllers\API\FieldController;
use App\Http\Controllers\API\Auth\PasswordResetController;



Route::group(["middleware" => ['auth:sanctum']], function () {
    Route::get("/logout", [AuthController::class, 'logout']);

    // Rotas para o Athlete
    Route::get('/athletes', [AthleteController::class, 'index']);
    Route::get('/athlete/{athlete_id}', [AthleteController::class, 'show']);
    Route::post('/athlete', [AthleteController::class, 'store']);
    Route::put('/athlete/{athlete_id}', [AthleteController::class, 'update']);

    // Rotas para o Coach
    Route::get('/coachs', [CoachController::class, 'index']);
    Route::get('/coach/{coach_id}', [CoachController::class, 'show']);
    Route::post('/coach', [CoachController::class, 'store']);
    Route::put('/coach/{coach_id}', [CoachController::class, 'update']);

    // Rotas para o Field
    Route::get('/fields', [FieldController::class, 'index']);
    Route::get('/field/{field_id}', [FieldController::class, 'show']);
    Route::post('/field', [FieldController::class, 'store']);
    Route::put('/field/{field_id}', [FieldController::class, 'update']);
});


//Rotas públicas

Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);
Route::post('password/email', [PasswordResetController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [PasswordResetController::class, 'reset'])->middleware('signed')->name('password.reset');
