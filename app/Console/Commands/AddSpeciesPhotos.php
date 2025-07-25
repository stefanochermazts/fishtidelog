<?php

namespace App\Console\Commands;

use App\Models\FishSpecies;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class AddSpeciesPhotos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'species:add-photos {--dry-run : Show what would be done without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add placeholder photos for common fish species';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        
        // Specie comuni con URL di foto placeholder
        $speciesWithPhotos = [
            'Orata' => 'https://picsum.photos/seed/orata/400/300',
            'Sparus aurata' => 'https://picsum.photos/seed/orata/400/300',
            'Spigola' => 'https://picsum.photos/seed/spigola/400/300',
            'Dicentrarchus labrax' => 'https://picsum.photos/seed/spigola/400/300',
            'Tonno' => 'https://picsum.photos/seed/tonno/400/300',
            'Thunnus thynnus' => 'https://picsum.photos/seed/tonno/400/300',
            'Rombo' => 'https://picsum.photos/seed/rombo/400/300',
            'Psetta maxima' => 'https://picsum.photos/seed/rombo/400/300',
            'Sarago' => 'https://picsum.photos/seed/sarago/400/300',
            'Diplodus sargus' => 'https://picsum.photos/seed/sarago/400/300',
            'Dentice' => 'https://picsum.photos/seed/dentice/400/300',
            'Dentex dentex' => 'https://picsum.photos/seed/dentice/400/300',
            'Pagello' => 'https://picsum.photos/seed/pagello/400/300',
            'Pagellus erythrinus' => 'https://picsum.photos/seed/pagello/400/300',
            'Merluzzo' => 'https://picsum.photos/seed/merluzzo/400/300',
            'Gadus morhua' => 'https://picsum.photos/seed/merluzzo/400/300',
            'Salmone' => 'https://picsum.photos/seed/salmone/400/300',
            'Salmo salar' => 'https://picsum.photos/seed/salmone/400/300',
            'Trota' => 'https://picsum.photos/seed/trota/400/300',
            'Salmo trutta' => 'https://picsum.photos/seed/trota/400/300',
        ];
        
        $this->info('Aggiungendo foto placeholder per le specie comuni...');
        $updatedCount = 0;
        
        foreach ($speciesWithPhotos as $speciesName => $photoUrl) {
            // Cerca la specie nel database
            $species = FishSpecies::where('common_name_it', 'ILIKE', "%{$speciesName}%")
                ->orWhere('common_name_en', 'ILIKE', "%{$speciesName}%")
                ->orWhere('scientific_name', 'ILIKE', "%{$speciesName}%")
                ->whereNull('photo_path')
                ->first();
                
            if ($species) {
                if ($isDryRun) {
                    $this->line("→ Aggiungerebbe foto per: {$species->scientific_name} ({$species->common_name_it})");
                } else {
                    try {
                        // Scarica l'immagine placeholder
                        $response = Http::get($photoUrl);
                        
                        if ($response->successful()) {
                            $filename = 'species/placeholder_' . strtolower(str_replace(' ', '_', $species->scientific_name)) . '.jpg';
                            Storage::disk('public')->put($filename, $response->body());
                            
                            // Aggiorna il record della specie
                            $species->update(['photo_path' => $filename]);
                            
                            $this->info("✓ Aggiunta foto per: {$species->scientific_name} ({$species->common_name_it})");
                            $updatedCount++;
                        } else {
                            $this->warn("✗ Errore download per: {$species->scientific_name}");
                        }
                    } catch (\Exception $e) {
                        $this->error("✗ Errore per {$species->scientific_name}: " . $e->getMessage());
                    }
                }
            }
        }
        
        if ($isDryRun) {
            $this->warn('Questo è un dry-run. Esegui senza --dry-run per applicare le modifiche.');
        } else {
            $this->info("Completato! Aggiornate {$updatedCount} specie con foto placeholder.");
        }
        
        return 0;
    }
}
