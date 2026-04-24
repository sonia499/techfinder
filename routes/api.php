<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\UtilisateurController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserCompetenceController;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

// Routes protégées par Sanctum
Route::middleware('auth:sanctum')->group(function () {

    Route::apiResource('competences', CompetenceController::class);
    Route::get('competences/search', [CompetenceController::class, 'search']);

    Route::apiResource('utilisateurs', UtilisateurController::class);
    Route::apiResource('interventions', InterventionController::class);

    // User-Competences
    Route::post('user-competences', [UserCompetenceController::class, 'store']);
    Route::delete('user-competences', [UserCompetenceController::class, 'destroy']);
    Route::get('utilisateurs/{code_user}/competences', [UserCompetenceController::class, 'userCompetences']);

    Route::post('/logout', [AuthController::class, 'logout']);
});
