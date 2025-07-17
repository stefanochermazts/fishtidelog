<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FishingTrip;
use App\Models\FishCatch;
use App\Models\FishingSpot;
use Illuminate\Support\Facades\Auth;

class StatisticsWidget extends Component
{
    public $loading = true;
    public $totalTrips;
    public $totalCatches;
    public $totalWeight;
    public $monthlyTrips;
    public $recentCatches;
    public $favoriteSpots;

    protected $listeners = ['refreshStats' => 'loadStatistics'];

    public function mount()
    {
        $this->loadStatistics();
    }

    public function loadStatistics()
    {
        $this->loading = true;

        // Carica le statistiche in background per migliorare le performance
        $this->dispatch('$refresh');

        $user = Auth::user();

        // Statistiche principali
        $this->totalTrips = FishingTrip::where('user_id', $user->id)->count();
        $this->totalCatches = FishCatch::whereHas('fishingTrip', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->count();
        
        $this->totalWeight = FishCatch::whereHas('fishingTrip', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->sum('weight');

        // Uscite di questo mese
        $this->monthlyTrips = FishingTrip::where('user_id', $user->id)
            ->whereMonth('start_time', now()->month)
            ->whereYear('start_time', now()->year)
            ->count();

        // Catture recenti
        $this->recentCatches = FishCatch::whereHas('fishingTrip', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })
        ->with('fishingTrip')
        ->latest('catch_time')
        ->take(5)
        ->get();

        // Punti preferiti
        $this->favoriteSpots = FishingSpot::where('user_id', $user->id)
            ->withCount(['fishingTrips' => function ($query) use ($user) {
                $query->where('user_id', $user->id);
            }])
            ->orderBy('fishing_trips_count', 'desc')
            ->take(3)
            ->get();

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.statistics-widget');
    }
} 