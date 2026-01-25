<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sig_prob', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utilisateur_id')->constrained('utilisateur')->cascadeOnDelete();
            $table->foreignId('ressource_id')->nullable()->constrained('ressource')->cascadeOnDelete();
            $table->text('problem');
            $table->text('reponse')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sig_prob');
    }
};