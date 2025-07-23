<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class InitializeExistingUserTrials extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:initialize-trials';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Inizializza il trial di 6 mesi per tutti gli utenti esistenti che non lo hanno ancora';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🚀 Inizializzazione trial per utenti esistenti...');
        
        $usersWithoutTrial = User::whereNull('trial_ends_at')->get();
        
        if ($usersWithoutTrial->count() === 0) {
            $this->info('✅ Tutti gli utenti hanno già un trial inizializzato.');
            return Command::SUCCESS;
        }
        
        $this->info("📋 Trovati {$usersWithoutTrial->count()} utenti senza trial.");
        
        $bar = $this->output->createProgressBar($usersWithoutTrial->count());
        $bar->start();
        
        foreach ($usersWithoutTrial as $user) {
            $user->initializeTrial();
            $this->line("  ✅ Trial inizializzato per: {$user->name} ({$user->email})");
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        
        $this->info("🎉 Trial inizializzato per {$usersWithoutTrial->count()} utenti!");
        $this->comment('Tutti gli utenti ora hanno 6 mesi di trial gratuito.');
        
        return Command::SUCCESS;
    }
}
