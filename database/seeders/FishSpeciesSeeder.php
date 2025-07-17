<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FishSpecies;
use Illuminate\Support\Facades\File;

class FishSpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = database_path('seeders/fish_species_data.csv');
        
        if (!File::exists($csvFile)) {
            $this->command->error('File CSV non trovato: ' . $csvFile);
            return;
        }
        
        $csvData = array_map('str_getcsv', file($csvFile));
        $headers = array_shift($csvData); // Rimuove l'intestazione
        
        $this->command->info('Caricamento specie di pesci...');
        
        $count = 0;
        foreach ($csvData as $row) {
            // Verifica che il numero di colonne corrisponda
            if (count($row) !== count($headers)) {
                $this->command->warn('Riga saltata - numero di colonne non corrispondente: ' . implode(',', $row));
                continue;
            }
            
            $data = array_combine($headers, $row);
            
            // Pulisce i dati
            $data = array_map('trim', $data);
            
            // Converte i valori vuoti in null
            $data = array_map(function($value) {
                return $value === '' ? null : $value;
            }, $data);
            
            try {
                FishSpecies::updateOrCreate(
                    ['scientific_name' => $data['scientific_name']],
                    [
                        'common_name_en' => $data['common_name_en'],
                        'common_name_it' => $data['common_name_it'],
                        'common_name_fr' => $data['common_name_fr'],
                        'common_name_de' => $data['common_name_de'],
                        'family' => $data['family'],
                        'order' => $data['order'],
                        'description_en' => $data['description_en'],
                        'description_it' => $data['description_it'],
                        'description_fr' => $data['description_fr'],
                        'description_de' => $data['description_de'],
                        'habitat' => $data['habitat'],
                        'max_length' => $data['max_length'],
                        'max_weight' => $data['max_weight'],
                        'conservation_status' => $data['conservation_status'],
                        'is_active' => true,
                    ]
                );
                $count++;
            } catch (\Exception $e) {
                $this->command->error('Errore nel caricamento della specie: ' . $data['scientific_name'] . ' - ' . $e->getMessage());
            }
        }
        
        $this->command->info("Caricate {$count} specie di pesci.");
    }
}
