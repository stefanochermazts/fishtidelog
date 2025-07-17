<?php

namespace App\Http\Controllers;

use App\Models\FishSpecies;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class FishSpeciesController extends Controller
{
    /**
     * Cerca specie per autocompletamento
     */
    public function search(Request $request): JsonResponse
    {
        $search = $request->get('q', '');
        
        if (strlen($search) < 2) {
            return response()->json([]);
        }
        
        $species = FishSpecies::active()
            ->searchByName($search)
            ->limit(20)
            ->get()
            ->map(function ($species) {
                return [
                    'id' => $species->id,
                    'text' => $species->full_name,
                    'scientific_name' => $species->scientific_name,
                    'common_name' => $species->common_name,
                    'family' => $species->family,
                    'description' => $species->description,
                ];
            });
        
        return response()->json($species);
    }

    /**
     * Ottiene i dettagli di una specie
     */
    public function show(FishSpecies $species): JsonResponse
    {
        return response()->json([
            'id' => $species->id,
            'scientific_name' => $species->scientific_name,
            'common_name' => $species->common_name,
            'full_name' => $species->full_name,
            'family' => $species->family,
            'order' => $species->order,
            'description' => $species->description,
            'habitat' => $species->habitat,
            'max_length' => $species->max_length,
            'max_weight' => $species->max_weight,
            'conservation_status' => $species->conservation_status,
        ]);
    }

    /**
     * Ottiene le statistiche di una specie
     */
    public function statistics(FishSpecies $species): JsonResponse
    {
        $stats = $species->statistics;
        
        return response()->json([
            'species' => $species->full_name,
            'statistics' => $stats,
        ]);
    }
}
