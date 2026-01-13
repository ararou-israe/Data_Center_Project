<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('utilisateur', function (Blueprint $table) {
            
            $table->id();
         $table->string('nom');
         $table->string('prenom');
          $table->string('email');
          $table->string('password');

         $table->enum('roles', [
           'utilisateur_interne',
           'responsable',
           'admin'
          ])->default('utilisateur_interne');

          $table->enum('status', ['en attente','active','disactive']) ->default('en attente');
          $table->timestamps();
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateur');
    }
};
