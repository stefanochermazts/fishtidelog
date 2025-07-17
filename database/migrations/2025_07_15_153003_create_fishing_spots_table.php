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
        Schema::create('fishing_spots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->string('address')->nullable();
            $table->string('type')->nullable(); // shore, boat, pier, etc.
            $table->json('best_times')->nullable(); // best fishing times
            $table->json('species_common')->nullable(); // common species found
            $table->boolean('is_public')->default(false);
            $table->boolean('is_favorite')->default(false);
            $table->timestamps();
            
            $table->index(['user_id']);
            $table->index(['latitude', 'longitude']);
            $table->unique(['user_id', 'latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishing_spots');
    }
};
