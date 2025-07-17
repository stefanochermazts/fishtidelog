<?php

namespace App\Http\Controllers;

use App\Models\FishCatch;
use App\Models\FishingTrip;
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

    public function create()
    {
        $user = Auth::user();
        $trips = $user->fishingTrips()
            ->where('end_time', '>=', now()->subDays(30)) // Solo uscite recenti
            ->orderBy('start_time', 'desc')
            ->get();
            
        return view('catches.create', compact('trips'));
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

        // Gestione foto
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('catches', 'public');
            $data['photo_path'] = $path;
        }

        $catch = $trip->catches()->create($data);

        return redirect()->route('catches.show', $catch)
            ->with('success', __('messages.catch_created'));
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

        return redirect()->route('catches.show', $catch)
            ->with('success', __('messages.catch_updated'));
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
