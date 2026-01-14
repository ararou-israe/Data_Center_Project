<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\inscriptionController;

// --- ROUTES PUBLIQUES ---
Route::get('/', function () {
    
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// inscription 
Route::get('/register', [InscriptionController::class, 'create'])
    ->name('register');

Route::post('/register', [InscriptionController::class, 'store'])
    ->name('register.store');

Route::get('/confirmation', [InscriptionController::class, 'confirmation'])
    ->name('confirmation');


//  ROUTES PROTÉGÉES (Utilisateurs connectés uniquement) 
Route::middleware(['auth'])->group(function () {
    
    // 1. Dashboard de redirection 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Section ADMIN (saad)
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function() { return "Tableau de bord Admin"; })->name('admin.dashboard');
        Route::get('/admin/users', function() { return "Liste des utilisateurs"; });
    });

    // 3. Section RESPONSABLE TECHNIQUE (Hajar)
    Route::middleware(['role:responsable'])->group(function () {
        Route::get('/responsable/dashboard', [ResourceController::class, 'dashboard'])->name('responsable.dashboard');
        Route::get('/responsable/validations', function() { return "Demandes en attente"; });
    });

    // 4. Section UTILISATEUR INTERNE (Israe)
    
    Route::middleware(['role:utilisateur_interne'])->group(function () {
        Route::get('/utilisateur/dashboard', function() { return "Espace de réservation"; })->name('utilisateur.dashboard');
        Route::get('/reservation/creer', function() { return "Formulaire de réservation"; });
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});