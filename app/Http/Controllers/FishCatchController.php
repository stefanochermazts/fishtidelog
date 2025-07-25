<?php

namespace App\Http\Controllers;

use App\Models\FishCatch;
use App\Models\FishingTrip;
use App\Models\FishSpecies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class FishCatchController extends Controller
{
    use AuthorizesRequests;
    
    public function index()
    {
        $user = Auth::user();
        $catches = $user->fishingTrips()
            ->with('catches')
            ->whereHas('catches')
            ->latest('start_time')
            ->get()
            ->pluck('catches')
            ->flatten()
            ->sortByDesc('catch_time');
            
        return view('catches.index', compact('catches'));
    }

    public function create(Request $request)
    {
        $user = Auth::user();
        
        // Se viene passato un fishing_trip_id, preseleziona quella uscita
        $selectedTripId = $request->get('fishing_trip_id');
        $redirectTo = $request->get('redirect_to', 'catches');
        
        // Carica le uscite recenti (ultimi 30 giorni)
        $trips = $user->fishingTrips()
            ->where('end_time', '>=', now()->subDays(30))
            ->orderBy('start_time', 'desc')
            ->get();
        
        // Se c'è un'uscita selezionata, assicurati che sia inclusa nella lista
        if ($selectedTripId) {
            $selectedTrip = $user->fishingTrips()->find($selectedTripId);
            if ($selectedTrip && !$trips->contains('id', $selectedTripId)) {
                // Aggiungi l'uscita selezionata se non è già nella lista
                $trips = $trips->prepend($selectedTrip);
            }
        }
            
        return view('catches.create', compact('trips', 'selectedTripId', 'redirectTo'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fishing_trip_id' => 'required|exists:fishing_trips,id',
            'species' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0|max:100',
            'length' => 'nullable|numeric|min:0|max:500',
            'bait_used' => 'nullable|string|max:255',
            'technique_used' => 'nullable|string|max:255',
            'catch_time' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'notes' => 'nullable|string|max:1000',
            'released' => 'boolean',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Verifica che l'uscita appartenga all'utente
        $trip = Auth::user()->fishingTrips()->findOrFail($request->fishing_trip_id);

        $data = $request->except('photo');
        $data['released'] = $request->has('released');
        
        // Converti ID specie in nome se necessario
        if (is_numeric($data['species'])) {
            $fishSpecies = FishSpecies::find($data['species']);
            if ($fishSpecies) {
                $data['species'] = $fishSpecies->common_name ?: $fishSpecies->scientific_name;
            }
        }

        // Gestione foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('catches', 'public');
            $data['photo_path'] = $path;
        }

        $catch = $trip->catches()->create($data);

        // Gestione redirect
        $redirectTo = $request->get('redirect_to', 'catches');
        
        if ($redirectTo === 'fishing-trip') {
            return redirect()->route('fishing-trips.show', $trip)
                ->with('success', __('messages.catch_created'));
        } else {
            return redirect()->route('catches.show', $catch)
                ->with('success', __('messages.catch_created'));
        }
    }

    public function show(FishCatch $catch)
    {
        // Verifica che la cattura appartenga all'utente
        $this->authorize('view', $catch);
        
        return view('catches.show', compact('catch'));
    }

    public function edit(FishCatch $catch)
    {
        // Verifica che la cattura appartenga all'utente
        $this->authorize('update', $catch);
        
        $user = Auth::user();
        $trips = $user->fishingTrips()
            ->where('end_time', '>=', now()->subDays(30))
            ->orderBy('start_time', 'desc')
            ->get();
            
        return view('catches.edit', compact('catch', 'trips'));
    }

    public function update(Request $request, FishCatch $catch)
    {
        // Verifica che la cattura appartenga all'utente
        $this->authorize('update', $catch);

        $request->validate([
            'fishing_trip_id' => 'required|exists:fishing_trips,id',
            'species' => 'required|string|max:255',
            'weight' => 'nullable|numeric|min:0|max:100',
            'length' => 'nullable|numeric|min:0|max:500',
            'bait_used' => 'nullable|string|max:255',
            'technique_used' => 'nullable|string|max:255',
            'catch_time' => 'required|date',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'notes' => 'nullable|string|max:1000',
            'released' => 'boolean',
            'photo' => 'nullable|image|max:2048'
        ]);

        // Verifica che l'uscita appartenga all'utente
        $trip = Auth::user()->fishingTrips()->findOrFail($request->fishing_trip_id);

        $data = $request->except('photo');
        $data['released'] = $request->has('released');
        
        // Converti ID specie in nome se necessario
        if (is_numeric($data['species'])) {
            $fishSpecies = FishSpecies::find($data['species']);
            if ($fishSpecies) {
                $data['species'] = $fishSpecies->common_name ?: $fishSpecies->scientific_name;
            }
        }

        // Gestione foto
        if ($request->hasFile('photo')) {
            // Elimina la foto precedente se esiste
            if ($catch->photo_path) {
                Storage::disk('public')->delete($catch->photo_path);
            }
            $path = $request->file('photo')->store('catches', 'public');
            $data['photo_path'] = $path;
        }

        $catch->update($data);

        // Gestione redirect
        $redirectTo = $request->get('redirect_to', 'catches');
        
        if ($redirectTo === 'fishing-trip') {
            return redirect()->route('fishing-trips.show', $trip)
                ->with('success', __('messages.catch_updated'));
        } else {
            return redirect()->route('catches.show', $catch)
                ->with('success', __('messages.catch_updated'));
        }
    }

    public function destroy(FishCatch $catch)
    {
        // Verifica che la cattura appartenga all'utente
        $this->authorize('delete', $catch);

        // Elimina la foto se esiste
        if ($catch->photo_path) {
            Storage::disk('public')->delete($catch->photo_path);
        }

        $catch->delete();

        return redirect()->route('catches.index')
            ->with('success', __('messages.catch_deleted'));
    }
}
