<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TideData extends Model
{
    protected $fillable = [
        'latitude',
        'longitude',
        'date',
        'tide_data',
        'expires_at'
    ];

    protected $casts = [
        'date' => 'date',
        'tide_data' => 'array',
        'expires_at' => 'datetime'
    ];

    /**
     * Trova dati delle maree esistenti o restituisce null
     */
    public static function findCached($latitude, $longitude, $date)
    {
        return static::where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->where('date', $date)
            ->where('expires_at', '>', now())
            ->first();
    }

    /**
     * Salva i dati delle maree nel cache
     */
    public static function cacheTideData($latitude, $longitude, $date, $tideData)
    {
        // I dati scadono dopo 24 ore
        $expiresAt = now()->addHours(24);

        return static::updateOrCreate(
            [
                'latitude' => $latitude,
                'longitude' => $longitude,
                'date' => $date
            ],
            [
                'tide_data' => $tideData,
                'expires_at' => $expiresAt
            ]
        );
    }

    /**
     * Pulisce i dati scaduti
     */
    public static function cleanExpired()
    {
        return static::where('expires_at', '<', now())->delete();
    }
}
