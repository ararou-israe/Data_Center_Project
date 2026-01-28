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
        Schema::create('reservation', function (Blueprint $table) {
            $table->id();
              

            // user who requests
            $table->foreignId('utilisateur_id')
                  ->constrained('utilisateur')
                  ->cascadeOnDelete();

            $table->foreignId('ressource_id')
                  ->constrained('ressource')
                  ->cascadeOnDelete();

            $table->enum('status', ['En attente','Approuvee','Refusee','active','Termine'])
                  ->default('En attente');

            $table->text('justification');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
             $table->text('decision_note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation');
    }
};