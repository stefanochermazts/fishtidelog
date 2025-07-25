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
        Schema::table('fish_species', function (Blueprint $table) {
            $table->string('photo_path')->nullable()->after('conservation_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fish_species', function (Blueprint $table) {
            $table->dropColumn('photo_path');
        });
    }
};
