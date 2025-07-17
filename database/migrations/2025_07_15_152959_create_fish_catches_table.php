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
        Schema::create('fish_catches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fishing_trip_id')->constrained()->onDelete('cascade');
            $table->string('species');
            $table->decimal('weight', 6, 2)->nullable(); // in kg
            $table->decimal('length', 6, 2)->nullable(); // in cm
            $table->string('bait_used')->nullable();
            $table->string('technique_used')->nullable();
            $table->time('catch_time');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->text('notes')->nullable();
            $table->string('photo_path')->nullable();
            $table->boolean('released')->default(false);
            $table->timestamps();
            
            $table->index(['fishing_trip_id', 'catch_time']);
            $table->index(['species']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fish_catches');
    }
};
