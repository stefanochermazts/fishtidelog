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
        Schema::create('fish_species', function (Blueprint $table) {
            $table->id();
            $table->string('scientific_name')->unique(); // Nome scientifico
            $table->string('common_name_en'); // Nome comune in inglese
            $table->string('common_name_it')->nullable(); // Nome comune in italiano
            $table->string('common_name_fr')->nullable(); // Nome comune in francese
            $table->string('common_name_de')->nullable(); // Nome comune in tedesco
            $table->string('family')->nullable(); // Famiglia
            $table->string('order')->nullable(); // Ordine
            $table->text('description_en')->nullable(); // Descrizione in inglese
            $table->text('description_it')->nullable(); // Descrizione in italiano
            $table->text('description_fr')->nullable(); // Descrizione in francese
            $table->text('description_de')->nullable(); // Descrizione in tedesco
            $table->string('habitat')->nullable(); // Habitat
            $table->string('max_length')->nullable(); // Lunghezza massima
            $table->string('max_weight')->nullable(); // Peso massimo
            $table->string('conservation_status')->nullable(); // Stato di conservazione
            $table->boolean('is_active')->default(true); // Se la specie è attiva
            $table->timestamps();
            
            // Indici per le ricerche
            $table->index(['scientific_name']);
            $table->index(['common_name_en']);
            $table->index(['common_name_it']);
            $table->index(['common_name_fr']);
            $table->index(['common_name_de']);
            $table->index(['family']);
            $table->index(['is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fish_species');
    }
};
