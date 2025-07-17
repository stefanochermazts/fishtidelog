<?php

namespace App\Http\Controllers;

use App\Models\FishingTrip;
use App\Models\FishCatch;
use App\Models\FishingSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $recentTrips = $user->fishingTrips()
            ->with('catches')
            ->latest('start_time')
            ->take(5)
            ->get();
            
        $recentCatches = $user->fishingTrips()
            ->with('catches')
            ->whereHas('catches')
            ->get()
            ->pluck('catches')
            ->flatten()
            ->sortByDesc('catch_time')
            ->take(5);
            
        $totalTrips = $user->fishingTrips()->count();
        $totalCatches = $user->total_catches;
        $totalWeight = $user->total_weight;
        $favoriteSpots = $user->fishingSpots()->where('is_favorite', true)->take(3)->get();
        
        // Statistiche del mese corrente
        $currentMonth = now()->startOfMonth();
        $monthlyTrips = $user->fishingTrips()
            ->where('start_time', '>=', $currentMonth)
            ->count();
        $monthlyCatches = $user->fishingTrips()
            ->join('fish_catches', 'fishing_trips.id', '=', 'fish_catches.fishing_trip_id')
            ->where('fishing_trips.start_time', '>=', $currentMonth)
            ->count();
        
        return view('dashboard', compact(
            'recentTrips',
            'recentCatches',
            'totalTrips',
            'totalCatches',
            'totalWeight',
            'favoriteSpots',
            'monthlyTrips',
            'monthlyCatches'
        ));
    }
    
    public function statistics()
    {
        $user = Auth::user();
        
        // Statistiche per specie
        $speciesStats = $user->fishingTrips()
            ->join('fish_catches', 'fishing_trips.id', '=', 'fish_catches.fishing_trip_id')
            ->selectRaw('species, COUNT(*) as count, SUM(weight) as total_weight')
            ->groupBy('species')
            ->orderBy('count', 'desc')
            ->get();
            
        // Statistiche mensili
        $monthlyStats = $user->fishingTrips()
            ->selectRaw('EXTRACT(MONTH FROM start_time) as month, COUNT(*) as trips, SUM(EXTRACT(EPOCH FROM (COALESCE(end_time, NOW()) - start_time))/60) as total_minutes')
            ->where('start_time', '>=', now()->subMonths(12))
            ->groupBy('month')
            ->get();
            
        return view('statistics', compact('speciesStats', 'monthlyStats'));
    }
    
    public function map()
    {
        $user = Auth::user();
        
        // Carica solo i dati necessari per la mappa
        $trips = $user->fishingTrips()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select('id', 'title', 'start_time', 'latitude', 'longitude', 'location_name')
            ->withCount('catches as total_catches')
            ->get()
            ->map(function ($trip) {
                return [
                    'id' => $trip->id,
                    'title' => $trip->title,
                    'start_time' => $trip->start_time->format('d/m/Y H:i'),
                    'latitude' => (float) $trip->latitude,
                    'longitude' => (float) $trip->longitude,
                    'location_name' => $trip->location_name,
                    'total_catches' => $trip->total_catches
                ];
            });
            
        $spots = $user->fishingSpots()
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select('id', 'name', 'type', 'description', 'latitude', 'longitude', 'is_favorite')
            ->get()
            ->map(function ($spot) {
                return [
                    'id' => $spot->id,
                    'name' => $spot->name,
                    'type' => $spot->type,
                    'description' => $spot->description,
                    'latitude' => (float) $spot->latitude,
                    'longitude' => (float) $spot->longitude,
                    'is_favorite' => (bool) $spot->is_favorite
                ];
            });
        
        return view('map', compact('trips', 'spots'));
    }
}
