<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'instructorID',
        'category_id',
        'title',
        'price',
        'thumbnail',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructorID');
    }

    public function subcourses(): HasMany
    {
        return $this->hasMany(Subcourse::class, 'course_id');
    }

    public function studentCourses(): HasMany
    {
        return $this->hasMany(StudentCourse::class, 'courseID');
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(
            Student::class,
            'student_course',
            'courseID',
            'studentID'
        )->withPivot(['completion', 'completed'])->withTimestamps();
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(CourseRating::class, 'courseID');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

     public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Accessor untuk menghitung rata-rata rating
     */
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    /**
     * Accessor untuk menghitung jumlah student
     */
    public function getStudentCountAttribute()
    {
        return $this->studentCourses()->count();
    }
}