<?php

namespace App\Providers;

use App\Models\FishingTrip;
use App\Models\FishingSpot;
use App\Models\FishCatch;
use App\Policies\FishingTripPolicy;
use App\Policies\FishingSpotPolicy;
use App\Policies\FishCatchPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        FishingTrip::class => FishingTripPolicy::class,
        FishingSpot::class => FishingSpotPolicy::class,
        FishCatch::class => FishCatchPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
