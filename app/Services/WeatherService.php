<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    private $baseUrl = 'https://api.openweathermap.org/data/2.5';
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweathermap.key', '');
    }

    public function getWeatherForecast($latitude, $longitude, $date = null)
    {
        if (empty($this->apiKey)) {
            return [
                'success' => false,
                'message' => 'API key OpenWeatherMap non configurata'
            ];
        }

        $date = $date ?: now()->format('Y-m-d');
        $cacheKey = "weather_forecast_{$latitude}_{$longitude}_{$date}";

        return Cache::remember($cacheKey, 1800, function () use ($latitude, $longitude, $date) {
            try {
                // Ottieni previsioni per 5 giorni
                $response = Http::get("{$this->baseUrl}/forecast", [
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'lang' => 'it'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    if (isset($data['list'])) {
                        // Trova la previsione per la data specificata
                        $targetDate = date('Y-m-d', strtotime($date));
                        $forecast = null;
                        
                        foreach ($data['list'] as $item) {
                            $itemDate = date('Y-m-d', $item['dt']);
                            if ($itemDate === $targetDate) {
                                $forecast = $item;
                                break;
                            }
                        }
                        
                        if ($forecast) {
                            return [
                                'success' => true,
                                'data' => [
                                    'temperature' => round($forecast['main']['temp']),
                                    'feels_like' => round($forecast['main']['feels_like']),
                                    'humidity' => $forecast['main']['humidity'],
                                    'pressure' => $forecast['main']['pressure'],
                                    'description' => $forecast['weather'][0]['description'],
                                    'icon' => $forecast['weather'][0]['icon'],
                                    'wind_speed' => round($forecast['wind']['speed'] * 3.6, 1), // m/s to km/h
                                    'wind_direction' => $forecast['wind']['deg'] ?? 0,
                                    'clouds' => $forecast['clouds']['all'],
                                    'date' => $date,
                                    'location' => $data['city']['name'] ?? 'Sconosciuta'
                                ]
                            ];
                        }
                    }
                }

                return [
                    'success' => false,
                    'message' => 'Impossibile ottenere le previsioni meteo'
                ];

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Errore di connessione: ' . $e->getMessage()
                ];
            }
        });
    }

    public function getCurrentWeather($latitude, $longitude)
    {
        if (empty($this->apiKey)) {
            return [
                'success' => false,
                'message' => 'API key OpenWeatherMap non configurata'
            ];
        }

        $cacheKey = "current_weather_{$latitude}_{$longitude}";

        return Cache::remember($cacheKey, 900, function () use ($latitude, $longitude) {
            try {
                $response = Http::get("{$this->baseUrl}/weather", [
                    'lat' => $latitude,
                    'lon' => $longitude,
                    'appid' => $this->apiKey,
                    'units' => 'metric',
                    'lang' => 'it'
                ]);

                if ($response->successful()) {
                    $data = $response->json();
                    
                    return [
                        'success' => true,
                        'data' => [
                            'temperature' => round($data['main']['temp']),
                            'feels_like' => round($data['main']['feels_like']),
                            'humidity' => $data['main']['humidity'],
                            'pressure' => $data['main']['pressure'],
                            'description' => $data['weather'][0]['description'],
                            'icon' => $data['weather'][0]['icon'],
                            'wind_speed' => round($data['wind']['speed'] * 3.6, 1),
                            'wind_direction' => $data['wind']['deg'] ?? 0,
                            'clouds' => $data['clouds']['all'],
                            'location' => $data['name'] ?? 'Sconosciuta'
                        ]
                    ];
                }

                return [
                    'success' => false,
                    'message' => 'Impossibile ottenere i dati meteo attuali'
                ];

            } catch (\Exception $e) {
                return [
                    'success' => false,
                    'message' => 'Errore di connessione: ' . $e->getMessage()
                ];
            }
        });
    }
} 