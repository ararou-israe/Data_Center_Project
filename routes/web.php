<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\inscriptionController;
use App\Http\Controllers\reservController; 

// routes generales

// Page login
Route::get('/', function () {
    return view('welcome');
})->name('login');

// Submit login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//  page Inscription
Route::get('/register', [InscriptionController::class, 'create'])->name('register');
Route::post('/register', [InscriptionController::class, 'store'])->name('register.store');
Route::get('/confirmation', [InscriptionController::class, 'confirmation'])->name('confirmation');


// ====================== ROUTES PROTÉGÉES ======================
Route::middleware(['auth'])->group(function () {

    // Dashboard générique (redirection après login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ================= ADMIN =================
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function() {
            return "Tableau de bord Admin";
        })->name('admin.dashboard');

        Route::get('/admin/users', function() {
            return "Liste des utilisateurs";
        });
    });

    // ================= RESPONSABLE TECHNIQUE =================
    Route::middleware(['role:responsable'])->group(function () {
        Route::get('/responsable/dashboard', [ResourceController::class, 'dashboard'])
            ->name('responsable.dashboard');

        Route::get('/responsable/validations', function() {
            return "Demandes en attente";
        });
    });

    // interface de  UTILISATEUR INTERNE  enseignant ingenieur er doctorant
    Route::middleware(['role:utilisateur_interne'])->group(function () {

        // Dashboard utilisateur interne ( ressources + tableau + formulaire)
        Route::get('/utilisateur/dashboard', [reservController::class, 'index'])
            ->name('utilisateur.dashboard');

        // Stockage demande réservation
        Route::post('/reservation/store', [reservController::class, 'store'])
            ->name('reservation.store');
        // Soumettre un signalement de problème
        Route::post('/sig-prob', [reservController::class, 'storeSigProb'])->name('sigProb.store');    
           
    });

    // ================= LOGOUT =================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});