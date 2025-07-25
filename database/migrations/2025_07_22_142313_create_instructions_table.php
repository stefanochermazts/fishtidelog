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
        // Migrazione vuota - la tabella instructions esiste già
        // Non facciamo nulla per evitare conflitti
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Non facciamo nulla nel rollback
    }
}; 