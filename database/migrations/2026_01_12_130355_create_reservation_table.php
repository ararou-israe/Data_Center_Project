<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
              

            $table->foreignId('utilisateur_id')
                  ->constrained('utilisateur')
                  ->cascadeOnDelete();

            $table->foreignId('ressource_id')
                  ->constrained('ressource')
                  ->cascadeOnDelete();

            $table->enum('status', ['En attente','Approuvee','Refusee','active','Termine'])
                  ->default('En attente');

           $table->text('justification')->nullable();
           $table->date('date_debut'); 
           $table->date('date_fin');   
             $table->text('decision_note')->nullable();
            $table->timestamps();
        });
    }

    
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};
