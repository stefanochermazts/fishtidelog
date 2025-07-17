<?php

namespace App\Http\Controllers;

use App\Services\TideService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TideController extends Controller
{
    protected $tideService;

    public function __construct(TideService $tideService)
    {
        $this->tideService = $tideService;
    }

    /**
     * Mostra la pagina principale delle maree
     */
    public function index()
    {
        return view('tides.index');
    }

    /**
     * Ottiene i dati delle maree per coordinate specifiche
     */
    public function getTidesByCoordinates(Request $request): JsonResponse
    {
        $request->validate([
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'date' => 'nullable|date'
        ]);

        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $date = $request->input('date');

        $result = $this->tideService->getTides($latitude, $longitude, $date);

        if ($result) {
            return response()->json([
                'success' => true,
                'data' => $result['data'],
                'from_cache' => $result['from_cache']
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Impossibile ottenere i dati delle maree per queste coordinate'
        ], 400);
    }
} 