<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    // afficher le formulaire d'inscription
    public function create()
    {
        return view('inscription');
    }

    
    public function store(Request $request)
    {
        
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
                'roles.required' => '❌ Veuillez sélectionner votre identite.',
            ]
        );

        // creer un utilisateur
        Utilisateur::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roles' => $request->roles,
            'status' => 'en attente',
        ]);

        //  Redirection vers page confirmation
        return redirect()->route('confirmation');
    }

    // page confirmation
    public function confirmation()
    {
        return view('confirmation');
    }
}