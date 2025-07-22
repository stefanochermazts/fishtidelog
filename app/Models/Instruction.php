<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title',
        'content',
        'order',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get localized title
     */
    public function getLocalizedTitle($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->title[$locale] ?? $this->title['it'] ?? '';
    }

    /**
     * Get localized content
     */
    public function getLocalizedContent($locale = null)
    {
        $locale = $locale ?: app()->getLocale();
        return $this->content[$locale] ?? $this->content['it'] ?? '';
    }

    /**
     * Scope for active instructions
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered instructions
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }
}
