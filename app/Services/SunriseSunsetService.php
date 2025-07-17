<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SunriseSunsetService
{
    private $baseUrl = 'https://api.sunrise-sunset.org/json';

    public function getSunriseSunset($latitude, $longitude, $date = null)
    {
        $date = $date ?: now()->format('Y-m-d');
        $cacheKey = "sunrise_sunset_{$latitude}_{$longitude}_{$date}";

        return Cache::remember($cacheKey, 3600, function () use ($latitude, $longitude, $date) {
            try {
                $response = Http::get($this->baseUrl, [
                    'lat' => $latitude,
                    'lng' => $longitude,
                    'date' => $date,
                    'formatted' => 0
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if ($data['status'] === 'OK') {
                        $results = $data['results'];
                        
                        return [
                            'success' => true,
                            'data' => [
                                'sunrise' => $this->formatTime($results['sunrise']),
                                'sunset' => $this->formatTime($results['sunset']),
                                'solar_noon' => $this->formatTime($results['solar_noon']),
                                'day_length' => $this->formatDuration($results['day_length']),
                                'civil_twilight_begin' => $this->formatTime($results['civil_twilight_begin']),
                                'civil_twilight_end' => $this->formatTime($results['civil_twilight_end']),
                                'nautical_twilight_begin' => $this->formatTime($results['nautical_twilight_begin']),
                                'nautical_twilight_end' => $this->formatTime($results['nautical_twilight_end']),
                                'astronomical_twilight_begin' => $this->formatTime($results['astronomical_twilight_begin']),
                                'astronomical_twilight_end' => $this->formatTime($results['astronomical_twilight_end']),
                                'date' => $date
                            ]
                        ];
                    }
                }

                return [
                    'success' => false,
                    'message' => 'Impossibile ottenere i dati di alba e tramonto'
                ];

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Errore di connessione: ' . $e->getMessage()
                ];
            }
        });
    }

    private function formatTime($isoTime)
    {
        $date = new \DateTime($isoTime);
        $date->setTimezone(new \DateTimeZone('Europe/Rome'));
        return $date->format('H:i');
    }

    private function formatDuration($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        return sprintf('%02d:%02d', $hours, $minutes);
    }
} 