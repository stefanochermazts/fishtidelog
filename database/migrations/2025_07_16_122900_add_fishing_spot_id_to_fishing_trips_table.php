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
        Schema::table('fishing_trips', function (Blueprint $table) {
            $table->foreignId('fishing_spot_id')->nullable()->constrained()->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fishing_trips', function (Blueprint $table) {
            $table->dropForeign(['fishing_spot_id']);
            $table->dropColumn('fishing_spot_id');
        });
    }
};
