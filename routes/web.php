<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResourceController;

// --- ROUTES PUBLIQUES ---
Route::get('/', function () {
    // Redirection automatique si déjà connecté pour éviter l'erreur 419
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', function () {
    return "Page d'inscription";
})->name('register');


// --- ROUTES PROTÉGÉES ---
Route::middleware(['auth'])->group(function () {
    
    // 1. Point d'entrée unique (redirige selon le rôle)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 2. Section ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', function() { return "Tableau de bord Admin"; })->name('admin.dashboard');
    });

    // 3. Section RESPONSABLE TECHNIQUE (Hajar)
    Route::middleware(['role:responsable'])->group(function () {
        // Page principale
        Route::get('/responsable/dashboard', [DashboardController::class, 'index'])->name('responsable.dashboard');

        // ACTIONS DE GESTION (Les nouvelles routes à ajouter)
        // Décision sur réservation avec justification
        Route::post('/reservation/decider/{id}', [DashboardController::class, 'decider'])->name('reservation.decider');

        // Changement de statut technique (Maintenance/Actif)
        Route::post('/ressource/status/{id}', [DashboardController::class, 'updateStatus'])->name('ressource.status');

        // Modération des messages
        Route::delete('/commentaires/{id}', [DashboardController::class, 'destroyCommentaire'])->name('commentaires.delete');
    });

    // 4. Section UTILISATEUR INTERNE
    Route::middleware(['role:utilisateur_interne'])->group(function () {
        Route::get('/utilisateur/dashboard', function() { return "Espace de réservation"; })->name('utilisateur.dashboard');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::post('/ressource/store', [DashboardController::class, 'store'])->name('ressource.store');

    Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/'); // Redirige vers l'accueil ou la page login
})->name('logout');
});