<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class TestStatisticsQuery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-statistics-query';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the statistics query with PostgreSQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::first();
        
        if (!$user) {
            $this->error('Nessun utente trovato nel database');
            return;
        }
        
        $this->info('Testando query statistiche con PostgreSQL...');
        
        try {
            $result = $user->fishingTrips()
                ->selectRaw('EXTRACT(MONTH FROM start_time) as month, COUNT(*) as trips, SUM(EXTRACT(EPOCH FROM (COALESCE(end_time, NOW()) - start_time))/60) as total_minutes')
                ->where('start_time', '>=', now()->subMonths(12))
                ->groupBy('month')
                ->get();
                
            $this->info('Query eseguita con successo!');
            $this->info('Risultati: ' . $result->count() . ' record trovati');
            
            foreach ($result as $row) {
                $this->line("Mese: {$row->month}, Viaggi: {$row->trips}, Minuti: " . round($row->total_minutes ?? 0, 2));
            }
            
        } catch (\Exception $e) {
            $this->error('Errore nella query: ' . $e->getMessage());
        }
    }
}
