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
        Schema::create('fishing_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->text('description')->nullable();
            $table->dateTime('start_time');
            $table->dateTime('end_time')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->string('location_name')->nullable();
            $table->string('weather_conditions')->nullable();
            $table->decimal('temperature', 4, 1)->nullable();
            $table->string('wind_direction')->nullable();
            $table->decimal('wind_speed', 4, 1)->nullable();
            $table->string('tide_phase')->nullable();
            $table->decimal('tide_height', 4, 2)->nullable();
            $table->string('lunar_phase')->nullable();
            $table->text('notes')->nullable();
            $table->json('equipment_used')->nullable();
            $table->boolean('is_public')->default(false);
            $table->timestamps();
            
            $table->index(['user_id', 'start_time']);
            $table->index(['latitude', 'longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fishing_trips');
    }
};
