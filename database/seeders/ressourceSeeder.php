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
                'etat' => 'disponible',
                'description' => 'Serveur physique pour le Data Center.',
                'cpu' => 8,
                'ram' => 32,
                'storage' => 1000,
                'os' => 'Linux',
                "type_stockage" => 'SSD',
                "emplacement" => 'salle A',
                "bande_passante" => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 1,
                'code' => 'SRV-002',
                'nom' => 'Serveur backup',
                'etat' => 'maintenance',
                'description' => 'Serveur secondaire pour le Data Center.',
                'cpu' => 12,
                'ram' => 64,
                'storage' => 4000,
                'os' => 'Linux',
                "type_stockage" => 'SSD',
                "emplacement" => 'salle B',
                "bande_passante" => null,
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
                'etat' => 'disponible',
                'description' => 'Machine virtuelle pour le développement et les tests.',
                'cpu' => 4,
                'ram' => 8,
                'storage' => 200,
                'os' => 'Linux',
                "type_stockage" => 'SSD',
                "emplacement" => 'salle C',
                "bande_passante" => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 2,
                'code' => 'VM-002',
                'nom' => 'VM Windows',
                'etat' => 'indisponible',
                'description' => 'Machine virtuelle Windows pour projets et tests.',
                'cpu' => 4,
                'ram' => 16,
                'storage' => 250,
                'os' => 'Windows',
                "type_stockage" => 'SSD',
                "emplacement" => 'salle D',
                "bande_passante" => null,
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
                'etat' => 'disponible',
                'description' => 'Stockage central pour les projets du Data Center.',
                'cpu' => null,
                'ram' => null,
                'storage' => 10240,
                'os' => 'Linux',
                "type_stockage" => 'SSD',
                "emplacement" => 'salle E',
                "bande_passante" => null,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 3,
                'code' => 'STO-002',
                'nom' => 'SAN',
                'etat' => 'maintenance',
                'description' => 'Stockage SAN pour les données critiques.',
                'cpu' => null,
                'ram' => null,
                'storage' => 40960,
                'os' => null,
                "type_stockage" => 'HDD',
                "emplacement" => 'salle F',
                "bande_passante" => null,
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
                'etat' => 'disponible',
                'description' => 'Équipement réseau central pour la distribution interne.',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                "type_stockage" => null,
                "emplacement" => 'salle F',
                "bande_passante" => 1000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 4,
                'code' => 'NET-002',
                'nom' => 'Firewall',
                'etat' => 'disponible',
                'description' => 'Pare-feu principal du Data Center.',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                "type_stockage" => null,
                "emplacement" => 'salle G',
                "bande_passante" => 1000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'categorie_id' => 4,
                'code' => 'NET-003',
                'nom' => 'Routeur',
                'etat' => 'maintenance',
                'description' => 'Routeur backbone pour la communication interne.',
                'cpu' => null,
                'ram' => null,
                'storage' => null,
                'os' => null,
                "type_stockage" => null,
                "emplacement" => 'salle G',
                'bande_passante' => 500,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}