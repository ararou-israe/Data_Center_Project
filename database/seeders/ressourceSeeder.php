<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RessourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ressource')->insert([
            [
                'categorie_id' => 1,
                'utilisateur_id' => 1, // responsable (doit exister)
                'code' => 'SRV-001',
                'nom' => 'Serveur principal',
                'etat' => 'disponible',
                'cpu' => 8,
                'ram' => 32,
                'storage' => 1000,
                'os' => 'Linux',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}