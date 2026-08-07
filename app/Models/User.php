<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStudent(): bool
    {
        return $this->role === 'student';
    }

    /**
     * Relations utiles pour le dashboard étudiant
     */
    public function scholarshipApplications()
    {
        return $this->hasMany(\App\Models\ScholarshipApplication::class);
    }

    public function courseEnrollments()
    {
        return $this->hasMany(\App\Models\CourseEnrollment::class);
    }
    public function studentProfile()
    {
        return $this->hasOne(\App\Models\StudentProfile::class);
    }
}
