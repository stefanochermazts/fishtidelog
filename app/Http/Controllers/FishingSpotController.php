<?php

namespace App\Http\Controllers;

use App\Models\FishingSpot;
use App\Services\TideService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FishingSpotController extends Controller
{
    use AuthorizesRequests;
    
    protected $tideService;
    
    public function __construct(TideService $tideService)
    {
        $this->tideService = $tideService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spots = Auth::user()->fishingSpots()
            ->latest()
            ->paginate(12);
            
        return view('fishing-spots.index', compact('spots'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fishing-spots.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'best_times' => 'nullable|array',
            'species_common' => 'nullable|array',
            'is_public' => 'boolean',
            'is_favorite' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['best_times'] = $validated['best_times'] ?? [];
        $validated['species_common'] = $validated['species_common'] ?? [];

        $spot = FishingSpot::create($validated);

        return redirect()->route('fishing-spots.show', $spot)
            ->with('success', __('messages.spot_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(FishingSpot $fishingSpot)
    {
        $this->authorize('view', $fishingSpot);
        
        // Carica le uscite collegate con le statistiche
        $fishingSpot->load(['fishingTrips' => function($query) {
            $query->with('catches')
                  ->latest('start_time')
                  ->take(5); // Prendi solo le ultime 5 uscite
        }]);
        
        // Calcola le statistiche
        $fishingSpot->trips_count = $fishingSpot->fishingTrips()->count();
        $fishingSpot->total_weight = $fishingSpot->fishingTrips()
            ->with('catches')
            ->get()
            ->sum(function($trip) {
                return $trip->catches->sum('weight');
            });
        
        return view('fishing-spots.show', compact('fishingSpot'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FishingSpot $fishingSpot)
    {
        $this->authorize('update', $fishingSpot);
        
        return view('fishing-spots.edit', compact('fishingSpot'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FishingSpot $fishingSpot)
    {
        $this->authorize('update', $fishingSpot);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'address' => 'nullable|string|max:255',
            'type' => 'nullable|string|max:255',
            'best_times' => 'nullable|array',
            'species_common' => 'nullable|array',
            'is_public' => 'boolean',
            'is_favorite' => 'boolean',
        ]);

        $validated['best_times'] = $validated['best_times'] ?? [];
        $validated['species_common'] = $validated['species_common'] ?? [];

        $fishingSpot->update($validated);

        return redirect()->route('fishing-spots.show', $fishingSpot)
            ->with('success', __('messages.spot_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FishingSpot $fishingSpot)
    {
        $this->authorize('delete', $fishingSpot);
        
        // Conta le uscite collegate per il messaggio
        $tripsCount = $fishingSpot->fishingTrips()->count();
        
        // Elimina il punto di pesca (le uscite verranno eliminate automaticamente per la foreign key constraint)
        $fishingSpot->delete();

        // Prepara il messaggio di successo
        $message = __('messages.spot_deleted');
        if ($tripsCount > 0) {
            $message .= ' ' . trans_choice('messages.trips_deleted_with_spot', $tripsCount, ['count' => $tripsCount]);
        }

        return redirect()->route('fishing-spots.index')
            ->with('success', $message);
    }

    /**
     * Toggle favorite status.
     */
    public function toggleFavorite(FishingSpot $fishingSpot)
    {
        $this->authorize('update', $fishingSpot);
        
        $fishingSpot->update([
            'is_favorite' => !$fishingSpot->is_favorite
        ]);

        $message = $fishingSpot->is_favorite 
            ? __('messages.added_to_favorites')
            : __('messages.removed_from_favorites');

        return redirect()->back()->with('success', $message);
    }
}
