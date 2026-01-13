<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use illeuminate\support\Facades\Hash;

class categorieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
        DB::table('categorie')->insert([ 
            [
                'nom' => 'serveur',
            "created_at" => now(),
            "updated_at" => now()
            ],
            [
                'nom' => 'machine virtuelle',
            "created_at" => now(),
            "updated_at" => now()
            ],
            [
                'nom' => 'Baies de stockage',
            "created_at" => now(),
            "updated_at" => now()
            ],
            [
                'nom' => 'equipements réseau',
            "created_at" => now(),
            "updated_at" => now()
            ]
        ]); 
    }
}