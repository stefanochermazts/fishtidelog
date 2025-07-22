<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FishingTrip;
use App\Models\FishingSpot;
use App\Models\FishCatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    /**
     * Home page pubblica
     */
    public function index()
    {
        // Statistiche pubbliche con cache di 10 minuti per migliorare le performance
        $stats = Cache::remember('home_stats', 600, function () {
            return [
                'total_users' => User::count(),
                'total_trips' => FishingTrip::count(),
                'total_spots' => FishingSpot::count(),
                'total_catches' => FishCatch::count(),
                'total_weight' => FishCatch::sum('weight') ?? 0,
            ];
        });

        return view('home', compact('stats'));
    }

    /**
     * Pagina delle funzionalità
     */
    public function features()
    {
        return view('features');
    }

    /**
     * Pagina dei prezzi
     */
    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Pagina di contatto
     */
    public function contact()
    {
        return view('contact');
    }
}
