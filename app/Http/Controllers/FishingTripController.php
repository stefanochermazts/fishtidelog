<?php

namespace App\Http\Controllers;

use App\Models\FishingTrip;
use App\Services\TideService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FishingTripController extends Controller
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
        $trips = Auth::user()->fishingTrips()
            ->with('catches')
            ->latest('start_time')
            ->paginate(10);
            
        return view('fishing-trips.index', compact('trips'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $fishingSpots = Auth::user()->fishingSpots()
            ->select('id', 'name', 'type', 'latitude', 'longitude', 'address')
            ->orderBy('name')
            ->get();
            
        return view('fishing-trips.create', compact('fishingSpots'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'fishing_spot_id' => 'nullable|exists:fishing_spots,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'location_name' => 'nullable|string|max:255',
            'weather_conditions' => 'nullable|string|max:255',
            'temperature' => 'nullable|numeric|between:-50,50',
            'wind_direction' => 'nullable|string|max:255',
            'wind_speed' => 'nullable|numeric|min:0',
            'tide_phase' => 'nullable|string|max:255',
            'tide_height' => 'nullable|numeric|between:-10,10',
            'lunar_phase' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'equipment_used' => 'nullable|array',
            'is_public' => 'boolean',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['equipment_used'] = $validated['equipment_used'] ?? [];

        $trip = FishingTrip::create($validated);

        return redirect()->route('fishing-trips.show', $trip)
            ->with('success', __('messages.trip_created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(FishingTrip $fishingTrip)
    {
        $this->authorize('view', $fishingTrip);
        
        $fishingTrip->load('catches');
        
        return view('fishing-trips.show', compact('fishingTrip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FishingTrip $fishingTrip)
    {
        $this->authorize('update', $fishingTrip);
        
        $fishingSpots = Auth::user()->fishingSpots()
            ->select('id', 'name', 'type', 'latitude', 'longitude', 'address')
            ->orderBy('name')
            ->get();
            
        return view('fishing-trips.edit', compact('fishingTrip', 'fishingSpots'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FishingTrip $fishingTrip)
    {
        $this->authorize('update', $fishingTrip);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'nullable|date|after:start_time',
            'fishing_spot_id' => 'nullable|exists:fishing_spots,id',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'location_name' => 'nullable|string|max:255',
            'weather_conditions' => 'nullable|string|max:255',
            'temperature' => 'nullable|numeric|between:-50,50',
            'wind_direction' => 'nullable|string|max:255',
            'wind_speed' => 'nullable|numeric|min:0',
            'tide_phase' => 'nullable|string|max:255',
            'tide_height' => 'nullable|numeric|between:-10,10',
            'lunar_phase' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'equipment_used' => 'nullable|array',
            'is_public' => 'boolean',
        ]);

        $validated['equipment_used'] = $validated['equipment_used'] ?? [];

        $fishingTrip->update($validated);

        return redirect()->route('fishing-trips.show', $fishingTrip)
            ->with('success', __('messages.trip_updated'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FishingTrip $fishingTrip)
    {
        $this->authorize('delete', $fishingTrip);
        
        // Conta le catture collegate per il messaggio
        $catchesCount = $fishingTrip->catches()->count();
        
        // Elimina l'uscita (le catture verranno eliminate automaticamente per la foreign key constraint)
        $fishingTrip->delete();

        // Prepara il messaggio di successo
        $message = __('messages.trip_deleted');
        if ($catchesCount > 0) {
            $message .= ' ' . trans_choice('messages.catches_deleted_with_trip', $catchesCount, ['count' => $catchesCount]);
        }

        return redirect()->route('fishing-trips.index')
            ->with('success', $message);
    }

    /**
     * End the fishing trip.
     */
    public function endTrip(FishingTrip $fishingTrip)
    {
        $this->authorize('update', $fishingTrip);
        
        $fishingTrip->update(['end_time' => now()]);

        return redirect()->route('fishing-trips.show', $fishingTrip)
            ->with('success', __('messages.trip_ended'));
    }
}
