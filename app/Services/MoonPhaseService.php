<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class MoonPhaseService
{
    private $baseUrl = 'https://www.farmsense.net/v1/moonphases/';

    public function getMoonPhase($date = null)
    {
        $date = $date ?: now()->format('Y-m-d');
        $cacheKey = "moon_phase_{$date}";

        return Cache::remember($cacheKey, 3600, function () use ($date) {
            try {
                $response = Http::get($this->baseUrl, [
                    'd1' => strtotime($date),
                    'd2' => strtotime($date)
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (!empty($data)) {
                        $moonData = $data[0];
                        
                        return [
                            'success' => true,
                            'data' => [
                                'phase' => $this->getPhaseName($moonData['Phase']),
                                'phase_number' => $moonData['Phase'],
                                'illumination' => round($moonData['Illumination'] * 100, 1),
                                'date' => $date,
                                'age' => round($moonData['Age'], 1)
                            ]
                        ];
                    }
                }

                return [
                    'success' => false,
                    'message' => 'Impossibile ottenere i dati lunari'
                ];

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Errore di connessione: ' . $e->getMessage()
                ];
            }
        });
    }

    private function getPhaseName($phaseNumber)
    {
        $phases = [
            0 => 'Luna Nuova',
            1 => 'Luna Crescente',
            2 => 'Primo Quarto',
            3 => 'Gibbosa Crescente',
            4 => 'Luna Piena',
            5 => 'Gibbosa Calante',
            6 => 'Ultimo Quarto',
            7 => 'Luna Calante'
        ];

        return $phases[$phaseNumber] ?? 'Sconosciuta';
    }
} 