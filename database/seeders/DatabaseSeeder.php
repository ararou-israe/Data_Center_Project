<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur;
use App\Models\Ressource;
use App\Models\Reservation;
use App\Models\Categorie;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Création d'une catégorie par défaut
        $cat = Categorie::create(['nom' => 'Serveurs Physiques']);

        // 2. Création du Responsable 
        $hajar = Utilisateur::create([
            'nom' => 'tighramte',
            'prenom' => 'hajar',
            'email' => 'hajar@datacenter.com',
            'password' => Hash::make('password'),
            'roles' => 'responsable' //
        ]);

        // 3. Création d'un Utilisateur Interne 
        $ingénieur = Utilisateur::create([
            'nom' => 'Alami',
            'prenom' => 'Ahmed',
            'email' => 'ahmed@datacenter.com',
            'password' => Hash::make('password'),
            'roles' => 'utilisateur_interne'
        ]);

        // 4. Ajout de ressources
        $srv1 = Ressource::create([
            'code' => 'SRV-PROD-01',
            'nom' => 'Serveur Web Production',
            'categorie_id' => $cat->id,
            'utilisateur_id' => $hajar->id,
            'cpu' => 16,
            'ram' => 64,
            'storage' => 1000,
            'os' => 'Linux',
            'etat' => 'disponible' 
        ]);

        Ressource::create([
            'code' => 'VM-DEV-02',
            'nom' => 'Machine Virtuelle Test',
            'categorie_id' => $cat->id,
            'utilisateur_id' => $hajar->id,
            'cpu' => 4,
            'ram' => 16,
            'storage' => 250,
            'os' => 'Windows',
            'etat' => 'maintenance'
        ]);

        // 5. Création d'une demande de réservation en attente
        Reservation::create([
            'utilisateur_id' => $ingénieur->id,
            'ressource_id' => $srv1->id,
            'date_debut' => '2026-02-01', 
           'date_fin' => '2026-02-15',
            'status' => 'en attente'
        ]);
    }
}