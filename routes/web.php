<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\reservController;

// =======================================================
// PUBLIC ROUTES
// =======================================================

// ✅ FIRST PAGE SEEN BY USER = INTERFACE
// (loaded via controller to always have $ressources)
Route::get('/', [ResourceController::class, 'index'])->name('home');

// Optional alias (same page)
Route::get('/interface', [ResourceController::class, 'index'])->name('interface');



// page de login
Route::get('/login', function () {
    return view('welcome'); // login blade
})->name('login');

// Login submit
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

// page d insceription
Route::get('/register', [InscriptionController::class, 'create'])->name('register');

// Register submit
Route::post('/register', [InscriptionController::class, 'store'])->name('register.store');

// page de confirmation après inscription
Route::get('/confirmation', [InscriptionController::class, 'confirmation'])->name('confirmation');


// les routes protégées 

Route::middleware(['auth'])->group(function () {

    // Generic dashboard 
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ---------------- ADMIN ----------------
    Route::middleware(['role:admin'])->group(function () {

        Route::get('/admin/dashboard', function () {
            return 'Tableau de bord Admin';
        })->name('admin.dashboard');

        Route::get('/admin/users', function () {
            return 'Liste des utilisateurs';
        });
    });

    // ---------------- RESPONSABLE TECHNIQUE ----------------
    Route::middleware(['role:responsable'])->group(function () {

        Route::get('/responsable/dashboard', [ResourceController::class, 'dashboard'])
            ->name('responsable.dashboard');

        Route::get('/responsable/validations', function () {
            return 'Demandes en attente';
        });
    });

    // interface de UTILISATEUR INTERNE enseignaant ingeninieur et doctorant
    Route::middleware(['role:utilisateur_interne'])->group(function () {
        // dashboard utilisateur interne(ressource tableau et formulaire)

        Route::get('/utilisateur/dashboard', [reservController::class, 'index'])
            ->name('utilisateur.dashboard');
            //stocker demande de reservation

        Route::post('/reservation/store', [reservController::class, 'store'])
            ->name('reservation.store');
            //signaler un probleme

        Route::post('/sig-prob', [reservController::class, 'storeSigProb'])
            ->name('sigProb.store');
    });

    // ---------------- LOGOUT ----------------
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');
});