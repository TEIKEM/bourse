<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'short_description',
        'description',
        'cta_label',
        'cta_link',
        'image_url',
        'order',
        'is_published',
    ];

    protected $casts = [
        'order' => 'integer',
        'is_published' => 'boolean',
    ];

    protected static function booted(): void
    {
        // Génère automatiquement le slug à partir du titre si non renseigné
        static::creating(function (Service $service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    /**
     * Ne retourne que les services publiés.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Trie par ordre d'affichage défini manuellement.
     */
    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('order')->orderBy('title');
    }

    /**
     * Permet d'utiliser le slug dans les URLs plutôt que l'ID.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
