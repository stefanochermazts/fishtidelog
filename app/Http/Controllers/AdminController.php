<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use App\Models\FishingTrip;
use App\Models\FishingSpot;
use App\Models\FishCatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    /**
     * Dashboard amministrazione
     */
    public function dashboard()
    {
        // Statistiche generali con cache di 5 minuti
        $stats = Cache::remember('admin_stats', 300, function () {
            return [
                'total_users' => User::count(),
                'premium_users' => User::where('subscription_ends_at', '>', now())->count(),
                'total_trips' => FishingTrip::count(),
                'total_spots' => FishingSpot::count(),
                'total_catches' => FishCatch::count(),
                'total_weight' => FishCatch::sum('weight') ?? 0,
                'new_contacts' => Contact::where('status', 'new')->count(),
            ];
        });

        // Utenti recenti
        $recentUsers = User::latest()->take(5)->get();

        // Contatti recenti
        $recentContacts = Contact::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentContacts'));
    }

    /**
     * Lista utenti
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Filtro per ruolo
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Filtro per stato premium
        if ($request->filled('premium_status')) {
            if ($request->premium_status === 'premium') {
                $query->where('subscription_ends_at', '>', now());
            } elseif ($request->premium_status === 'free') {
                $query->where(function ($q) {
                    $q->where('subscription_ends_at', '<=', now())
                      ->orWhereNull('subscription_ends_at');
                });
            }
        }

        // Ricerca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->latest()->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Dettagli utente
     */
    public function userDetails(User $user)
    {
        // Carica le relazioni per le statistiche
        $user->load(['fishingTrips', 'fishingSpots', 'fishCatches']);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Aggiorna ruolo utente
     */
    public function updateUserRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:user,admin'
        ]);

        // Impedisci di rimuovere l'ultimo admin
        if ($user->role === 'admin' && User::where('role', 'admin')->count() === 1) {
            return back()->with('error', 'Non è possibile rimuovere l\'ultimo amministratore.');
        }

        $user->update(['role' => $request->role]);

        return back()->with('success', 'Ruolo utente aggiornato con successo!');
    }

    /**
     * Attiva abbonamento premium
     */
    public function activateSubscription(Request $request, User $user)
    {
        $request->validate([
            'subscription_ends_at' => 'required|date|after:now'
        ]);

        $user->update([
            'subscription_ends_at' => $request->subscription_ends_at
        ]);

        return back()->with('success', 'Abbonamento premium attivato con successo!');
    }

    /**
     * Estendi periodo di prova
     */
    public function extendTrial(Request $request, User $user)
    {
        $request->validate([
            'trial_ends_at' => 'required|date|after:now'
        ]);

        $user->update([
            'trial_ends_at' => $request->trial_ends_at
        ]);

        return back()->with('success', 'Periodo di prova esteso con successo!');
    }

    /**
     * Cancella abbonamento
     */
    public function cancelSubscription(User $user)
    {
        $user->update([
            'subscription_ends_at' => now()
        ]);

        return back()->with('success', 'Abbonamento cancellato con successo!');
    }

    /**
     * Segna come scaduto
     */
    public function markAsExpired(User $user)
    {
        $user->update([
            'subscription_ends_at' => now()->subDay()
        ]);

        return back()->with('success', 'Utente segnato come scaduto!');
    }

    /**
     * Elimina utente
     */
    public function destroyUser(User $user)
    {
        // Impedisci di eliminare se stessi
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Non puoi eliminare il tuo stesso account.');
        }

        // Impedisci di eliminare l'ultimo admin
        if ($user->role === 'admin' && User::where('role', 'admin')->count() === 1) {
            return back()->with('error', 'Non è possibile eliminare l\'ultimo amministratore.');
        }

        $userName = $user->name;
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "Utente \"{$userName}\" eliminato con successo.");
    }

    /**
     * Lista contatti
     */
    public function contacts(Request $request)
    {
        $query = Contact::query();

        // Filtro per status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Ricerca
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }

        $contacts = $query->latest()->paginate(20);

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Dettagli contatto
     */
    public function contactDetails(Contact $contact)
    {
        // Segna come letto se è nuovo
        if ($contact->isNew()) {
            $contact->markAsRead();
        }

        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Segna contatto come risposto
     */
    public function markContactAsReplied(Contact $contact)
    {
        $contact->markAsReplied();

        return back()->with('success', 'Contatto segnato come risposto!');
    }
}
