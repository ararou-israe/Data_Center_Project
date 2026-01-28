<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reservation')->insert([
            [
                'utilisateur_id' => 1, // ID de l'utilisateur_interne
                'ressource_id' => 1,   // ID du Serveur principal
                'status' => 'en attente',
                'justification' => 'Besoin urgent pour mon projet de Cloud Computing.',
                'date_debut' => now()->addDays(1),
                'date_fin' => now()->addDays(5),
                'decision_note' => null, 
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}