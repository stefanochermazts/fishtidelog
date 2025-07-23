<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckExpiredSubscriptions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscriptions:check-expired
                          {--dry-run : Solo mostra cosa verrebbe fatto senza eseguire modifiche}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Controlla e aggiorna gli abbonamenti e trial scaduti';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');
        
        $this->info('🔍 Controllo abbonamenti e trial scaduti...');
        
        // Controlla trial scaduti
        $expiredTrials = User::where('subscription_status', 'trial')
            ->where('trial_ends_at', '<=', now())
            ->get();
            
        if ($expiredTrials->count() > 0) {
            $this->warn("📅 Trovati {$expiredTrials->count()} trial scaduti:");
            
            foreach ($expiredTrials as $user) {
                $this->line("  - {$user->name} ({$user->email}) - Scaduto: {$user->trial_ends_at->format('d/m/Y H:i')}");
                
                if (!$dryRun) {
                    $user->markAsExpired();
                    Log::info("Trial scaduto per utente: {$user->email}");
                }
            }
            
            if (!$dryRun) {
                $this->info("✅ {$expiredTrials->count()} trial marcati come scaduti.");
            }
        } else {
            $this->info('✅ Nessun trial scaduto trovato.');
        }
        
        // Controlla abbonamenti scaduti
        $expiredSubscriptions = User::where('subscription_status', 'active')
            ->where('subscription_ends_at', '<=', now())
            ->get();
            
        if ($expiredSubscriptions->count() > 0) {
            $this->warn("💳 Trovati {$expiredSubscriptions->count()} abbonamenti scaduti:");
            
            foreach ($expiredSubscriptions as $user) {
                $this->line("  - {$user->name} ({$user->email}) - Scaduto: {$user->subscription_ends_at->format('d/m/Y H:i')}");
                
                if (!$dryRun) {
                    $user->markAsExpired();
                    Log::info("Abbonamento scaduto per utente: {$user->email}");
                }
            }
            
            if (!$dryRun) {
                $this->info("✅ {$expiredSubscriptions->count()} abbonamenti marcati come scaduti.");
            }
        } else {
            $this->info('✅ Nessun abbonamento scaduto trovato.');
        }
        
        // Mostra trial in scadenza (prossimi 7 giorni)
        $expiringSoon = User::where('subscription_status', 'trial')
            ->where('trial_ends_at', '>', now())
            ->where('trial_ends_at', '<=', now()->addDays(7))
            ->get();
            
        if ($expiringSoon->count() > 0) {
            $this->warn("⚠️  {$expiringSoon->count()} trial in scadenza nei prossimi 7 giorni:");
            
            foreach ($expiringSoon as $user) {
                $daysRemaining = now()->diffInDays($user->trial_ends_at, false);
                $this->line("  - {$user->name} ({$user->email}) - Scade tra {$daysRemaining} giorni");
            }
        }
        
        if ($dryRun) {
            $this->comment('🔍 Esecuzione in modalità dry-run - nessuna modifica effettuata.');
            $this->comment('Rimuovi --dry-run per applicare le modifiche.');
        }
        
        $this->info('🎉 Controllo completato!');
        
        return Command::SUCCESS;
    }
}
