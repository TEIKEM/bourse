<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'university',
        'country',
        'flag',
        'type',
        'status_badge',
        'level',
        'coverage',
        'deadline',
        'capacity',
        'image_url',
        'is_published',
    ];

    protected $casts = [
        'deadline' => 'date',
        'capacity' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Ne retourne que les bourses publiées.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Filtre par mot-clé (titre ou université).
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('university', 'like', "%{$term}%");
        });
    }

    /**
     * Candidatures reçues pour cette bourse.
     */
    public function applications(): HasMany
    {
        return $this->hasMany(ScholarshipApplication::class);
    }

    /**
     * Formate la date limite pour l'affichage (ex: "30 Août 2026").
     */
    public function getFormattedDeadlineAttribute(): ?string
    {
        return $this->deadline?->translatedFormat('d F Y');
    }
}
