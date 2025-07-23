<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SubscriptionController extends Controller
{
    /**
     * Mostra la pagina di abbonamento scaduto
     */
    public function expired(): View
    {
        $user = auth()->user();
        
        return view('subscription.expired', [
            'user' => $user,
            'trialEndedAt' => $user->trial_ends_at,
            'subscriptionStatus' => $user->subscription_status,
        ]);
    }

    /**
     * Mostra la pagina di gestione abbonamento
     */
    public function manage(): View
    {
        $user = auth()->user();
        
        return view('subscription.manage', [
            'user' => $user,
            'isOnTrial' => $user->isOnTrial(),
            'trialDaysRemaining' => $user->trialDaysRemaining(),
            'hasActiveSubscription' => $user->hasActiveSubscription(),
        ]);
    }

    /**
     * Reindirizza al processo di pagamento (placeholder)
     */
    public function upgrade(): RedirectResponse
    {
        // Qui andrà l'integrazione con il sistema di pagamento
        // Per ora redirect alla pagina di pricing
        return redirect()->route('pricing')
            ->with('info', 'Sistema di pagamento in arrivo. Contatta l\'amministratore per attivare l\'abbonamento.');
    }

    /**
     * Pagina di conferma post-pagamento (placeholder)
     */
    public function success(): View
    {
        return view('subscription.success');
    }

    /**
     * Pagina di cancellazione pagamento (placeholder)
     */
    public function cancelled(): View
    {
        return view('subscription.cancelled');
    }
}
