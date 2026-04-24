<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\CompetenceController;
use App\Http\Controllers\Web\UtilisateurController; // ✅ Ajoute ce use

Route::get('/', function () {
    return view('welcome');
});

// Compétences
Route::get('/web/competences', [CompetenceController::class, 'index'])->name('web.competences.index');
Route::post('/web/competences', [CompetenceController::class, 'store'])->name('web.competences.store');
Route::get('/web/competences/{id}/edit', [CompetenceController::class, 'edit'])->name('web.competences.edit');
Route::put('/web/competences/{id}', [CompetenceController::class, 'update'])->name('web.competences.update');
Route::delete('/web/competences/{id}', [CompetenceController::class, 'destroy'])->name('web.competences.destroy');

// Utilisateurs ✅
Route::get('/web/utilisateurs', [UtilisateurController::class, 'index'])->name('web.utilisateurs.index');
Route::post('/web/utilisateurs', [UtilisateurController::class, 'store'])->name('web.utilisateurs.store');
Route::get('/web/utilisateurs/{id}/edit', [UtilisateurController::class, 'edit'])->name('web.utilisateurs.edit');
Route::put('/web/utilisateurs/{id}', [UtilisateurController::class, 'update'])->name('web.utilisateurs.update');
Route::delete('/web/utilisateurs/{id}', [UtilisateurController::class, 'destroy'])->name('web.utilisateurs.destroy');
