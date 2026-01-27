<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;




class sigProbSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sig_prob')->insert([
            [
                'utilisateur_id' => 1,
                'ressource_id' => 2,
                'problem' => 'La machine ne fonctionne pas correctement.',
                'reponse' => 'Le problème a été résolu .',
                "created_at" => now(),
                "updated_at" => now()

            ]
        ]);
    }
}