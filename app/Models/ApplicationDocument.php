<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class ApplicationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'documentable_type',
        'documentable_id',
        'label',
        'original_name',
        'path',
        'mime_type',
        'size',
    ];

    public function documentable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * URL publique pour télécharger/consulter le fichier.
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->path);
    }

    /**
     * Taille lisible (ex: "1.2 Mo").
     */
    public function getFormattedSizeAttribute(): string
    {
        if (! $this->size) {
            return '—';
        }

        return $this->size > 1048576
            ? round($this->size / 1048576, 1) . ' Mo'
            : round($this->size / 1024, 0) . ' Ko';
    }
}
