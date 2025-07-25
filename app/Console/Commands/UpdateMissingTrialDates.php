<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UpdateMissingTrialDates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-missing-trial-dates {--dry-run : Mostra cosa verrebbe aggiornato senza modificare i dati}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Aggiorna le date di trial mancanti per gli utenti esistenti con status expired';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        // Trova utenti con status expired ma senza trial_ends_at
        $usersToUpdate = User::where('subscription_status', 'expired')
            ->whereNull('trial_ends_at')
            ->get();
            
        $this->info("Trovati {$usersToUpdate->count()} utenti da aggiornare.");
        
        if ($usersToUpdate->isEmpty()) {
            $this->info('Nessun utente da aggiornare.');
            return;
        }
        
        if ($isDryRun) {
            $this->table(
                ['ID', 'Email', 'Creato il', 'Trial calcolato'],
                $usersToUpdate->map(function ($user) {
                    return [
                        $user->id,
                        $user->email,
                        $user->created_at->format('d/m/Y H:i'),
                        $user->created_at->addMonths(6)->format('d/m/Y H:i')
                    ];
                })->toArray()
            );
            
            $this->warn('Questo è un dry-run. Esegui senza --dry-run per applicare le modifiche.');
            return;
        }
        
        $updated = 0;
        $bar = $this->output->createProgressBar($usersToUpdate->count());
        $bar->start();
        
        foreach ($usersToUpdate as $user) {
            // Imposta trial_ends_at basato sulla data di creazione + 6 mesi
            $user->update([
                'trial_ends_at' => $user->created_at->addMonths(6)
            ]);
            
            $updated++;
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        $this->info("Aggiornati {$updated} utenti con successo.");
    }
}
