<?php

namespace App\Console\Commands;

use App\Services\TideService;
use Illuminate\Console\Command;

class CleanExpiredTideData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tides:clean-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pulisce i dati delle maree scaduti dal database';

    /**
     * Execute the console command.
     */
    public function handle(TideService $tideService)
    {
        $this->info('Pulizia dati delle maree scaduti...');
        
        $deleted = $tideService->cleanExpiredData();
        
        $this->info("Eliminati {$deleted} record scaduti.");
        
        return Command::SUCCESS;
    }
}
