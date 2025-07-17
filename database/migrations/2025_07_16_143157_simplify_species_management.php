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
        Schema::table('fish_catches', function (Blueprint $table) {
            // Rimuovi i campi complessi
            $table->dropForeign(['species_id']);
            $table->dropColumn(['species_id', 'custom_species_description', 'is_custom_species']);
            
            // Assicurati che species sia una stringa
            $table->string('species')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fish_catches', function (Blueprint $table) {
            // Ripristina i campi
            $table->foreignId('species_id')->nullable()->constrained('fish_species')->onDelete('set null');
            $table->text('custom_species_description')->nullable();
            $table->boolean('is_custom_species')->default(false);
        });
    }
};
