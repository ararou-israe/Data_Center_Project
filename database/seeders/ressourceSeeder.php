<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RessourceSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('ressource')->insert([

            // =======================
            // SERVEURS (categorie_id = 1)
            // =======================
            [
                'categorie_id' => 1,
                'code' => 'SRV-001',
                'nom' => 'Serveur principal',
                'description' => 'Serveur physique pour le Data Center.',
                'etat' => 'disponible',
                'cpu' => 8,
                'ram' => 32,
                'storage' => 1000,
                'os' => 'Linux',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 1,
                'code' => 'SRV-002',
                'nom' => 'Serveur backup',
                'description' => 'Serveur secondaire pour le Data Center.',
                'etat' => 'maintenance',
                'cpu' => 12,
                'ram' => 64,
                'storage' => 4000,
                'os' => 'Linux',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // =======================
            // MACHINES VIRTUELLES (categorie_id = 2)
            // =======================
            [
                'categorie_id' => 2,
                'code' => 'VM-001',
                'nom' => 'VM Ubuntu',
                'description' => 'Machine virtuelle pour le développement et les tests.',
                'etat' => 'disponible',
                'cpu' => 4,
                'ram' => 8,
                'storage' => 200,
                'os' => 'Linux',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 2,
                'code' => 'VM-002',
                'nom' => 'VM Windows',
                'description' => 'Machine virtuelle Windows pour projets et tests.',
                'etat' => 'indisponible',
                'cpu' => 4,
                'ram' => 16,
                'storage' => 250,
                'os' => 'Windows',
                'created_at' => now(),
                'updated_at' => now()
            ],

            // =======================
            // STOCKAGE (categorie_id = 3)
            // =======================
            [
                'categorie_id' => 3,
                'code' => 'STO-001',
                'nom' => 'NAS principal',
                'description' => 'Stockage central pour les projets du Data Center.',
                'etat' => 'disponible',
                'cpu' => null,
                'ram' => null,
                'storage' => 10240,
                'os' => 'Linux',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 3,
                'code' => 'STO-002',
                'nom' => 'SAN',
                'description' => 'Stockage SAN pour les données critiques.',
                'etat' => 'maintenance',
                'cpu' => null,
                'ram' => null,
                'storage' => 40960,
                'os' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],

            // =======================
            // RÉSEAU (categorie_id = 4)
            // =======================
            [
                'categorie_id' => 4,
                'code' => 'NET-001',
                'nom' => 'Switch coeur',
                'description' => 'Équipement réseau central pour la distribution interne.',
                'etat' => 'disponible',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 4,
                'code' => 'NET-002',
                'nom' => 'Firewall',
                'description' => 'Pare-feu principal du Data Center.',
                'etat' => 'disponible',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 4,
                'code' => 'NET-003',
                'nom' => 'Routeur',
                'description' => 'Routeur backbone pour la communication interne.',
                'etat' => 'maintenance',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}