<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class CourseEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_session_id',
        'status',
    ];

    public function documents(): MorphMany
    {
        return $this->morphMany(ApplicationDocument::class, 'documentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courseSession(): BelongsTo
    {
        return $this->belongsTo(CourseSession::class);
    }
}
