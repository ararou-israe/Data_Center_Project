<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class utilisateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('utilisateur')->Insert([
            [
                'nom' => 'ararou',
            'prenom' => 'israe',
            'email' => 'israe.ararou@example.com',
            'password' => hash::make('israe123'),
            'roles' => 'utilisateur_interne',
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now()
            ],
            [
                'nom' => 'tighramte',
                'prenom' => 'hajar',
                'email' => 'hajar.tighramte@example.com',
                'password' => hash::make('hajar123'),
                'roles' => 'responsable',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nom' => 'med',
                'prenom' => 'saad',
                'email' => 'saad.med@example.com',
                'password' => hash::make('saad123'),
                'roles' => 'admin',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}