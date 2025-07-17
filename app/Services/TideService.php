<?php

namespace App\Services;

use App\Models\TideData;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class TideService
{
    private $apiKey;
    private $baseUrl = 'https://www.worldtides.info/api/v3';

    public function __construct()
    {
        $this->apiKey = config('services.worldtides.key');
    }

    /**
     * Ottiene i dati delle maree per una località e data specifica
     */
    public function getTides($latitude, $longitude, $date = null)
    {
        // Se non è specificata una data, usa oggi
        $date = $date ?: now()->format('Y-m-d');
        
        // Controlla se i dati sono già nel cache
        $cachedData = TideData::findCached($latitude, $longitude, $date);
        if ($cachedData) {
            Log::info('Dati delle maree recuperati dal cache', [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'date' => $date
            ]);
            return [
                'data' => $cachedData->tide_data,
                'from_cache' => true
            ];
        }

        try {
            $params = [
                'heights' => 1,
                'extremes' => 1,
                'start' => strtotime($date),
                'length' => 86400, // 24 ore
                'key' => $this->apiKey
            ];

            $response = Http::get($this->baseUrl, $params + [
                'lat' => $latitude,
                'lon' => $longitude
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                if (isset($data['status']) && $data['status'] === 200) {
                    $formattedData = $this->formatTideData($data);
                    
                    // Salva i dati nel cache
                    TideData::cacheTideData($latitude, $longitude, $date, $formattedData);
                    
                    Log::info('Dati delle maree recuperati dall\'API e salvati nel cache', [
                        'latitude' => $latitude,
                        'longitude' => $longitude,
                        'date' => $date
                    ]);
                    
                    return [
                        'data' => $formattedData,
                        'from_cache' => false
                    ];
                } else {
                    Log::error('Errore API WorldTides', $data);
                    return null;
                }
            } else {
                Log::error('Errore nella chiamata API WorldTides', [
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return null;
            }
        } catch (Exception $e) {
            Log::error('Eccezione nel servizio maree', [
                'message' => $e->getMessage(),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'date' => $date
            ]);
            return null;
        }
    }

    /**
     * Formatta i dati delle maree per l'uso nell'applicazione
     */
    private function formatTideData($data)
    {
        $formatted = [
            'current' => null,
            'heights' => [],
            'extremes' => [],
            'next_high' => null,
            'next_low' => null,
            'current_status' => ''
        ];

        // Calcola l'altezza attuale
        if (isset($data['heights']) && !empty($data['heights'])) {
            $currentTime = time();
            $currentHeight = null;
            
            foreach ($data['heights'] as $height) {
                if ($height['dt'] <= $currentTime) {
                    $currentHeight = $height;
                } else {
                    break;
                }
            }
            
            if ($currentHeight) {
                $formatted['current'] = [
                    'height' => round($currentHeight['height'], 2),
                    'time' => date('H:i', $currentHeight['dt'])
                ];
            }
        }

        // Estremi (alta e bassa marea)
        if (isset($data['extremes'])) {
            $formatted['extremes'] = array_map(function($extreme) {
                return [
                    'type' => $extreme['type'] === 'High' ? 'alta' : 'bassa',
                    'height' => round($extreme['height'], 2),
                    'time' => date('H:i', $extreme['dt']),
                    'timestamp' => $extreme['dt']
                ];
            }, $data['extremes']);
        }

        // Prossima alta e bassa marea
        $currentTime = time();
        foreach ($formatted['extremes'] as $extreme) {
            if ($extreme['timestamp'] > $currentTime) {
                if ($extreme['type'] === 'alta' && !$formatted['next_high']) {
                    $formatted['next_high'] = $extreme;
                } elseif ($extreme['type'] === 'bassa' && !$formatted['next_low']) {
                    $formatted['next_low'] = $extreme;
                }
            }
        }

        // Determina lo stato attuale
        if ($formatted['current'] && $formatted['next_high'] && $formatted['next_low']) {
            $currentHeight = $formatted['current']['height'];
            $lastHigh = null;
            $lastLow = null;
            
            foreach ($formatted['extremes'] as $extreme) {
                if ($extreme['timestamp'] <= $currentTime) {
                    if ($extreme['type'] === 'alta') {
                        $lastHigh = $extreme;
                    } else {
                        $lastLow = $extreme;
                    }
                }
            }
            
            if ($lastHigh && $lastLow) {
                if ($lastHigh['timestamp'] > $lastLow['timestamp']) {
                    // L'ultima alta marea è più recente, quindi la marea sta scendendo
                    $formatted['current_status'] = 'marea calante';
                } else {
                    // L'ultima bassa marea è più recente, quindi la marea sta salendo
                    $formatted['current_status'] = 'marea montante';
                }
            }
        }

        return $formatted;
    }

    /**
     * Ottiene le maree per una località specifica
     */
    public function getTidesForLocation($location, $date = null)
    {
        // Coordinate predefinite per località comuni in Italia
        $locations = [
            'venezia' => [45.4371, 12.3326],
            'trieste' => [45.6495, 13.7768],
            'genova' => [44.4056, 8.9463],
            'napoli' => [40.8518, 14.2681],
            'palermo' => [38.1157, 13.3615],
            'cagliari' => [39.2238, 9.1217],
            'bari' => [41.1171, 16.8719],
            'ancona' => [43.6158, 13.5189],
            'livorno' => [43.5528, 10.3083],
            'taranto' => [40.4647, 17.2470]
        ];

        $location = strtolower($location);
        
        if (isset($locations[$location])) {
            [$lat, $lon] = $locations[$location];
            $result = $this->getTides($lat, $lon, $date);
            return $result ? $result['data'] : null;
        }

        return null;
    }

    /**
     * Pulisce i dati delle maree scaduti
     */
    public function cleanExpiredData()
    {
        $deleted = TideData::cleanExpired();
        Log::info('Dati delle maree scaduti eliminati', ['count' => $deleted]);
        return $deleted;
    }
} 