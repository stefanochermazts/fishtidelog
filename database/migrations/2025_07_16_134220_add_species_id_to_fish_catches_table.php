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
            $table->foreignId('species_id')->nullable()->constrained('fish_species')->onDelete('set null');
            $table->text('custom_species_description')->nullable(); // Per specie personalizzate
            $table->boolean('is_custom_species')->default(false); // Se è una specie personalizzata
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fish_catches', function (Blueprint $table) {
            $table->dropForeign(['species_id']);
            $table->dropColumn(['species_id', 'custom_species_description', 'is_custom_species']);
        });
    }
};
