<?php

namespace App\Http\Controllers;

use App\Services\MoonPhaseService;
use App\Services\SunriseSunsetService;
use App\Services\WeatherService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class EnvironmentalDataController extends Controller
{
    private $moonPhaseService;
    private $sunriseSunsetService;
    private $weatherService;

    public function __construct(
        MoonPhaseService $moonPhaseService,
        SunriseSunsetService $sunriseSunsetService,
        WeatherService $weatherService
    ) {
        $this->moonPhaseService = $moonPhaseService;
        $this->sunriseSunsetService = $sunriseSunsetService;
        $this->weatherService = $weatherService;
    }

    public function getEnvironmentalData(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
        ]);

        $date = $request->input('date');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        try {
            // Ottieni tutti i dati ambientali
            $moonData = $this->moonPhaseService->getMoonPhase($date);
            $sunData = $this->sunriseSunsetService->getSunriseSunset($latitude, $longitude, $date);
            $weatherData = $this->weatherService->getWeatherForecast($latitude, $longitude, $date);

            return response()->json([
                'success' => true,
                'data' => [
                    'moon' => $moonData,
                    'sun' => $sunData,
                    'weather' => $weatherData,
                    'date' => $date,
                    'coordinates' => [
                        'latitude' => $latitude,
                        'longitude' => $longitude
                    ]
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Errore nel recupero dei dati ambientali: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getMoonPhase(Request $request): JsonResponse
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->input('date');
        $result = $this->moonPhaseService->getMoonPhase($date);

        return response()->json($result);
    }

    public function getSunriseSunset(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'date' => 'required|date',
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $date = $request->input('date');

        $result = $this->sunriseSunsetService->getSunriseSunset($latitude, $longitude, $date);

        return response()->json($result);
    }

    public function getWeather(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'date' => 'required|date',
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $date = $request->input('date');

        $result = $this->weatherService->getWeatherForecast($latitude, $longitude, $date);

        return response()->json($result);
    }
} 