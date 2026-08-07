<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class CourseSession extends Model
{
    use HasFactory;

    // Table déjà nommée correctement par convention (CourseSession -> course_sessions),
    // mais on le précise pour la clarté.
    protected $table = 'course_sessions';

    protected $fillable = [
        'title',
        'language',
        'level',
        'description',
        'mode',
        'location',
        'address',
        'duration',
        'schedule',
        'start_date',     // texte existant, ex: "15 Août"
        'session_date',   // vraie date, pour tri/filtrage
        'capacity',
        'price',
        'badge_color',
        'status_badge',
        'image_url',
        'is_published',
    ];

    protected $casts = [
        'session_date' => 'date',
        'price' => 'decimal:2',
        'capacity' => 'integer',
        'is_published' => 'boolean',
    ];

    /**
     * Ne retourne que les sessions publiées.
     */
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_published', true);
    }

    /**
     * Prochaines sessions triées par date réelle (session_date).
     * Les sessions sans session_date renseignée passent en dernier.
     */
    public function scopeUpcoming(Builder $query): Builder
    {
        return $query->orderByRaw('session_date IS NULL, session_date ASC');
    }

    /**
     * Filtre par mot-clé (titre ou langue).
     */
    public function scopeSearch(Builder $query, ?string $term): Builder
    {
        if (! $term) {
            return $query;
        }

        return $query->where(function (Builder $q) use ($term) {
            $q->where('title', 'like', "%{$term}%")
              ->orWhere('language', 'like', "%{$term}%");
        });
    }

    /**
     * Le champ start_date existant est déjà un texte lisible ("15 Août"),
     * donc pas de transformation nécessaire — on l'expose tel quel.
     */
    public function getFormattedStartDateAttribute(): ?string
    {
        return $this->start_date;
    }

    /**
     * Prix formaté pour l'affichage (ex: "45 000 FCFA").
     */
    public function getFormattedPriceAttribute(): ?string
    {
        return $this->price ? number_format((float) $this->price, 0, ',', ' ') . ' FCFA' : null;
    }
}
