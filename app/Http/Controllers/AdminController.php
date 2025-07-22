<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FishingTrip;
use App\Models\FishingSpot;
use App\Models\FishCatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    /**
     * Dashboard principale dell'amministrazione
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'premium_users' => User::where('is_premium', true)->where('premium_until', '>', now())->count(),
            'total_trips' => FishingTrip::count(),
            'total_spots' => FishingSpot::count(),
            'total_catches' => FishCatch::count(),
            'total_weight' => FishCatch::sum('weight') ?? 0,
            'recent_users' => User::latest()->take(5)->get(),
            'recent_trips' => FishingTrip::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    /**
     * Lista di tutti gli utenti
     */
    public function users(Request $request)
    {
        $query = User::with(['fishingTrips', 'fishingSpots']);

        // Filtri
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        if ($request->filled('premium')) {
            if ($request->premium === 'true') {
                $query->where('is_premium', true)->where('premium_until', '>', now());
            } else {
                $query->where(function($q) {
                    $q->where('is_premium', false)
                      ->orWhere('premium_until', '<=', now())
                      ->orWhereNull('premium_until');
                });
            }
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Dettagli di un utente specifico
     */
    public function userDetails(User $user)
    {
        $stats = $user->getStats();
        $recentTrips = $user->fishingTrips()->with('catches')->latest()->take(10)->get();
        $recentSpots = $user->fishingSpots()->latest()->take(10)->get();

        return view('admin.users.show', compact('user', 'stats', 'recentTrips', 'recentSpots'));
    }

    /**
     * Aggiorna il ruolo di un utente
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        $user->update(['role' => $request->role]);

        return redirect()->back()->with('success', __('messages.user_role_updated'));
    }

    /**
     * Aggiorna lo stato premium di un utente
     */
    public function updateUserPremium(Request $request, User $user)
    {
        $request->validate([
            'is_premium' => 'required|boolean',
            'premium_until' => 'nullable|date|after:today'
        ]);

        $user->update([
            'is_premium' => $request->is_premium,
            'premium_until' => $request->is_premium ? $request->premium_until : null
        ]);

        return redirect()->back()->with('success', __('messages.user_premium_updated'));
    }

    /**
     * Elimina un utente
     */
    public function destroyUser(User $user)
    {
        // Impedisci l'eliminazione del proprio account
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', __('messages.cannot_delete_yourself'));
        }

        // Impedisci l'eliminazione dell'ultimo admin
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()->back()->with('error', __('messages.cannot_delete_last_admin'));
        }

        $userName = $user->name;
        
        // Laravel si occuperà automaticamente delle relazioni cascade/soft delete
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('messages.user_deleted_successfully', ['name' => $userName]));
    }
}
