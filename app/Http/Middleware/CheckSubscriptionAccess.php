<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscriptionAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Se non è autenticato, lascia passare (gestito da altri middleware)
        if (!$user) {
            return $next($request);
        }

        // Gli admin hanno sempre accesso
        if ($user->role === 'admin') {
            return $next($request);
        }

        // Verifica se l'utente può accedere al servizio
        if (!$user->canAccessService()) {
            // Se l'accesso è scaduto, reindirizza alla pagina di upgrade
            if ($user->hasExpiredAccess()) {
                return redirect()->route('subscription.expired')
                    ->with('error', 'Il tuo periodo di prova è scaduto. Aggiorna il tuo piano per continuare.');
            }
            
            // Se per qualche motivo non ha trial_ends_at settato, inizializza il trial
            if (!$user->trial_ends_at) {
                $user->initializeTrial();
                return $next($request);
            }
        }

        return $next($request);
    }
}
