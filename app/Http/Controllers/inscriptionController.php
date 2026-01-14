<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    // afficher le formulaire
    public function create()
    {
        return view('inscription');
    }

    // traiter l'inscription
    public function store(Request $request)
    {
        // 1. Validation avec messages personnalisés
        $request->validate(
            [
                'nom' => 'required|string|max:255',
                'prenom' => 'required|string|max:255',
                'email' => 'required|email|unique:utilisateur,email',
                'password' => 'required|min:8|confirmed',
                'roles' => 'required|in:utilisateur_interne,responsable',
            ],
            [
                'email.unique' => '❌ vous avez deja un compte avec cet email.',
                'email.required' => '❌ L’email est obligatoire.',
                'password.confirmed' => '❌ Les mots de passe ne correspondent pas.',
                'password.min' => '❌ Le mot de passe doit contenir au moins 8 caractères.',
                'roles.required' => '❌ Veuillez sélectionner un rôle.',
            ]
        );

        // 2. Création utilisateur
        Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => $request->roles,
            'status' => 'en attente',
        ]);

        // 3. Redirection vers page confirmation
        return redirect()->route('confirmation');
    }

    // page confirmation
    public function confirmation()
    {
        return view('confirmation');
    }
}