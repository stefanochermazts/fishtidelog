<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Lingue supportate
        $supportedLocales = ['it', 'en', 'de', 'fr'];
        
        // Controlla se c'è un parametro locale nella URL
        if ($request->has('locale') && in_array($request->get('locale'), $supportedLocales)) {
            $locale = $request->get('locale');
            Session::put('locale', $locale);
        }
        // Altrimenti controlla se c'è una lingua salvata in sessione
        elseif (Session::has('locale') && in_array(Session::get('locale'), $supportedLocales)) {
            $locale = Session::get('locale');
        }
        // Altrimenti usa la lingua di default (italiano)
        else {
            $locale = 'it';
            Session::put('locale', $locale);
        }
        
        // Imposta la lingua per l'applicazione
        App::setLocale($locale);
        
        // Debug: log del locale per verificare che funzioni
        \Log::info('SetLocale middleware: Setting locale to ' . $locale);
        
        return $next($request);
    }
} 