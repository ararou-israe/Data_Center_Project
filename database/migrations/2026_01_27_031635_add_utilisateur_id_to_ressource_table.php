<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::table('ressource', function (Blueprint $table) {
        
        $table->unsignedBigInteger('utilisateur_id')->nullable()->after('id');
        $table->foreign('utilisateur_id')->references('id')->on('utilisateur')->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('ressource', function (Blueprint $table) {
        $table->dropForeign(['utilisateur_id']);
        $table->dropColumn('utilisateur_id');
    });
}
};
