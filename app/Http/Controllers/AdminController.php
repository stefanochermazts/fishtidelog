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
            'trial_users' => User::where('subscription_status', 'trial')->count(),
            'premium_users' => User::where('subscription_status', 'active')->count(),
            'expired_users' => User::where('subscription_status', 'expired')->count(),
            'total_trips' => FishingTrip::count(),
            'total_spots' => FishingSpot::count(),
            'total_catches' => FishCatch::count(),
            'total_weight' => FishCatch::sum('weight') ?? 0,
            'recent_users' => User::latest()->take(5)->get(),
            'recent_trips' => FishingTrip::with('user')->latest()->take(5)->get(),
            'expiring_trials' => User::where('subscription_status', 'trial')
                ->where('trial_ends_at', '<=', now()->addDays(7))
                ->where('trial_ends_at', '>', now())
                ->count(),
            'active_users' => User::whereIn('subscription_status', ['trial', 'active'])->count(),
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

        if ($request->filled('subscription_status')) {
            $query->where('subscription_status', $request->subscription_status);
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

        return redirect()->back()->with('success', 'Ruolo utente aggiornato con successo.');
    }

    /**
     * Attiva manualmente l'abbonamento per un utente
     */
    public function activateSubscription(Request $request, User $user)
    {
        $request->validate([
            'months' => 'required|integer|min:1|max:24',
            'price' => 'required|numeric|min:0|max:999.99'
        ]);

        $user->activateSubscription($request->months, $request->price);

        return redirect()->back()->with('success', 
            "Abbonamento attivato per {$request->months} mesi a €{$request->price}/mese.");
    }

    /**
     * Estende il trial di un utente
     */
    public function extendTrial(Request $request, User $user)
    {
        $request->validate([
            'days' => 'required|integer|min:1|max:365'
        ]);

        if ($user->subscription_status === 'trial') {
            $newTrialEnd = $user->trial_ends_at ? 
                $user->trial_ends_at->addDays($request->days) : 
                now()->addDays($request->days);
                
            $user->update(['trial_ends_at' => $newTrialEnd]);
            
            return redirect()->back()->with('success', 
                "Trial esteso di {$request->days} giorni.");
        }

        return redirect()->back()->with('error', 
            'L\'utente non è in modalità trial.');
    }

    /**
     * Cancella l'abbonamento di un utente
     */
    public function cancelSubscription(User $user)
    {
        $user->cancelSubscription();

        return redirect()->back()->with('success', 
            'Abbonamento cancellato. L\'utente manterrà l\'accesso fino alla scadenza.');
    }

    /**
     * Marca un utente come scaduto
     */
    public function markAsExpired(User $user)
    {
        $user->markAsExpired();

        return redirect()->back()->with('success', 
            'Utente marcato come scaduto. L\'accesso è stato revocato.');
    }

    /**
     * Elimina un utente
     */
    public function destroyUser(User $user)
    {
        // Impedisci l'eliminazione del proprio account
        if ($user->id === Auth::id()) {
            return redirect()->back()->with('error', 'Non puoi eliminare il tuo stesso account.');
        }

        // Impedisci l'eliminazione dell'ultimo admin
        if ($user->isAdmin() && User::where('role', 'admin')->count() <= 1) {
            return redirect()->back()->with('error', 'Non puoi eliminare l\'ultimo amministratore.');
        }

        $userName = $user->name;
        
        // Laravel si occuperà automaticamente delle relazioni cascade/soft delete
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 
            "Utente {$userName} eliminato con successo.");
    }
}
