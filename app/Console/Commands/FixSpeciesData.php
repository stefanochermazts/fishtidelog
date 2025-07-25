<?php

namespace App\Console\Commands;

use App\Models\FishCatch;
use App\Models\FishSpecies;
use Illuminate\Console\Command;

class FixSpeciesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'catches:fix-species-data {--dry-run : Show what would be fixed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix fish catches that have species IDs instead of species names';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        $this->info('Cercando catture con ID numerici nel campo species...');
        
        // Trova catture dove species è un numero (probabilmente un ID)
        $problematicCatches = FishCatch::whereRaw('species ~ \'^[0-9]+$\'')->get();
        
        $this->info("Trovate {$problematicCatches->count()} catture con species come ID numerico.");
        
        if ($problematicCatches->isEmpty()) {
            $this->info('Nessuna cattura da correggere.');
            return 0;
        }
        
        $fixedCount = 0;
        
        foreach ($problematicCatches as $catch) {
            $speciesId = (int) $catch->species;
            
            // Cerca la specie corrispondente
            $fishSpecies = FishSpecies::find($speciesId);
            
            if ($fishSpecies) {
                $correctName = $fishSpecies->common_name_it ?: $fishSpecies->common_name_en ?: $fishSpecies->scientific_name;
                
                if ($isDryRun) {
                    $this->line("→ Cattura ID {$catch->id}: cambierebbe species da '{$catch->species}' a '{$correctName}'");
                } else {
                    $catch->update(['species' => $correctName]);
                    $this->info("✓ Cattura ID {$catch->id}: species aggiornata da '{$speciesId}' a '{$correctName}'");
                    $fixedCount++;
                }
            } else {
                if ($isDryRun) {
                    $this->warn("→ Cattura ID {$catch->id}: specie con ID {$speciesId} non trovata nel database");
                } else {
                    // Se non troviamo la specie, impostiamo un nome generico
                    $genericName = "Specie sconosciuta (ID: {$speciesId})";
                    $catch->update(['species' => $genericName]);
                    $this->warn("✗ Cattura ID {$catch->id}: specie ID {$speciesId} non trovata, impostata come '{$genericName}'");
                    $fixedCount++;
                }
            }
        }
        
        if ($isDryRun) {
            $this->warn('Questo è un dry-run. Esegui senza --dry-run per applicare le correzioni.');
        } else {
            $this->info("Completato! Corrette {$fixedCount} catture.");
        }
        
        return 0;
    }
}
