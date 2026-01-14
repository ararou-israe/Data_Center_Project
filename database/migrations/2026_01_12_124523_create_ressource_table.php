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
        Schema::create('ressource', function (Blueprint $table) {
             $table->id(); // BIGINT PK

            $table->foreignId('categorie_id')
                  ->constrained('categorie')
                  ->cascadeOnDelete();

            $table->string('code', 50)->unique();     // SRV-001, VM-014
            $table->string('nom', 150);
            

            $table->enum('etat', [
                'disponible',
                'maintenance',
                'indisponible',
            ])->default('disponible');
            $table->text('description')->nullable();
            $table->integer('cpu')->nullable();
            $table->integer('ram')->nullable();
            $table->integer('storage')->nullable();
            $table->enum('os', [
                'Linux',
                'Windows',
            ])->default('Linux')->nullable();

            $table->timestamps(); // created_at, updated_at
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ressource');
    }
};
