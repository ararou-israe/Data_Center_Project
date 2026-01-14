<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
 public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // On ajoute la condition 'status' => 'active' dans la tentative de connexion
    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'status' => 'active'])) {
        $request->session()->regenerate();
        $user = Auth::user();

        // Vos redirections habituelles
        if ($user->roles === 'admin') {
            return redirect()->intended('/admin/dashboard');
        } 
        
        if ($user->roles === 'responsable') {
            return redirect()->intended('/responsable/dashboard');
        }

        if ($user->roles === 'utilisateur_interne') {
            return redirect()->intended('/utilisateur/dashboard');
        }

        return redirect('/');
    }

    // Si la connexion échoue, on vérifie si c'est à cause du statut
    $userExists = \App\Models\Utilisateur::where('email', $credentials['email'])->first();
    
    if ($userExists && $userExists->status !== 'active') {
        return back()->withErrors([
            'email' => 'Votre compte est ' . $userExists->status . '. Veuillez contacter l\'administrateur.',
        ]);
    }

    return back()->withErrors(['email' => 'Identifiants incorrects.']);
}
}