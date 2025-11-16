<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Get the password for the user.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Student detail (1-1)
     */
    public function detail(): HasOne
    {
        return $this->hasOne(StudentDetail::class, 'studentID');
    }

    /**
     * Course enrollments
     */
    public function studentCourses(): HasMany
    {
        return $this->hasMany(StudentCourse::class, 'studentID');
    }

    /**
     * Courses enrolled (many-to-many via studentCourse)
     */
    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(
            Course::class,
            'student_course',
            'studentID',
            'courseID'
        )->withPivot(['completion', 'completed'])->withTimestamps();
    }

    /**
     * Ratings given by student
     */
    public function courseRatings(): HasMany
    {
        return $this->hasMany(CourseRating::class, 'studentID');
    }
}