<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\inscriptionController;
use App\Http\Controllers\reservController; 
use App\Http\Controllers\AdminController;
// routes generales
// ✅ FIRST PAGE SEEN BY USER = INTERFACE
// (loaded via controller to always have $ressources)
Route::get('/', [ResourceController::class, 'index'])->name('home');

// Optional alias (same page)
Route::get('/interface', [ResourceController::class, 'index'])->name('interface');


// page de login
Route::get('/login', function () {
    return view('welcome'); // login blade
})->name('login');

// Submit login
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

//  page Inscription
Route::get('/register', [InscriptionController::class, 'create'])->name('register');
Route::post('/register', [InscriptionController::class, 'store'])->name('register.store');
Route::get('/confirmation', [InscriptionController::class, 'confirmation'])->name('confirmation');


// ROUTES PROTÉGÉES 
Route::middleware(['auth'])->group(function () {

    // Dashboard générique (redirection après login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //  ADMIN 
    Route::middleware(['role:admin'])->group(function () {
    
        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('/admin/dashboard');
        Route::get('/admin/users', [AdminController::class, 'user'])->name('/admin/users');
        Route::get('/admin/ressources', [AdminController::class, 'ressource'])->name('/admin/ressources');

        /* Route::get('/admin/dashboard', function() {
            return "Tableau de bord Admin";
        })->name('admin.dashboard');

        Route::get('/admin/users', function() {
            return "Liste des utilisateurs";
        });
        Route::get('/admin', function() {
            return view('Administrateur');
        });*/
    });

   // RESPONSABLE TECHNIQUE 
Route::middleware(['auth', 'role:responsable'])->group(function () {
    
    // Page principale (Dashboard + Liste des ressources)
    Route::get('/responsable/dashboard', [DashboardController::class, 'index'])
        ->name('responsable.dashboard');

    //  Ajouter une ressource
    Route::post('/responsable/ressource/store', [DashboardController::class, 'store'])
        ->name('ressource.store');

    //  Changer l'état (Maintenance / Désactiver)
    Route::post('/responsable/ressource/{id}/status', [DashboardController::class, 'updateStatus'])
        ->name('ressource.status');

    //  Approuver ou Refuser une réservation
    Route::post('/responsable/reservation/{id}/decider', [DashboardController::class, 'decider'])
        ->name('responsable.decider');

        //Modération
        Route::delete('/responsable/moderation/{id}', [DashboardController::class, 'detruireSignalement'])
    ->name('responsable.moderation');
  

});
    // interface de  UTILISATEUR INTERNE  
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

    // LOGOUT 
   Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});