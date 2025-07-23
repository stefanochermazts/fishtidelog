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
        Schema::table('users', function (Blueprint $table) {
            // Campi per la gestione del trial e abbonamento
            $table->timestamp('trial_ends_at')->nullable()->after('email_verified_at');
            $table->enum('subscription_status', ['trial', 'active', 'expired', 'cancelled'])->default('trial')->after('trial_ends_at');
            $table->timestamp('subscription_starts_at')->nullable()->after('subscription_status');
            $table->timestamp('subscription_ends_at')->nullable()->after('subscription_starts_at');
            $table->decimal('subscription_price', 8, 2)->nullable()->after('subscription_ends_at');
            $table->string('subscription_currency', 3)->default('EUR')->after('subscription_price');
            $table->json('subscription_meta')->nullable()->after('subscription_currency')->comment('Metadati per sistema di pagamento');
            
            // Indici per performance
            $table->index(['subscription_status']);
            $table->index(['trial_ends_at']);
            $table->index(['subscription_ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['subscription_status']);
            $table->dropIndex(['trial_ends_at']);
            $table->dropIndex(['subscription_ends_at']);
            
            $table->dropColumn([
                'trial_ends_at',
                'subscription_status',
                'subscription_starts_at',
                'subscription_ends_at',
                'subscription_price',
                'subscription_currency',
                'subscription_meta'
            ]);
        });
    }
};
