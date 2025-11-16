<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Instructor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    /**
     * Instructor detail (1-1)
     */
    public function detail(): HasOne
    {
        return $this->hasOne(InstructorDetail::class, 'instructorID');
    }

    /**
     * Courses created by instructor
     */
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class, 'instructorID');
    }
}