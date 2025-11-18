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

    protected $primaryKey = 'courseID';

    protected $fillable = [
        'instructorID',
        'category_id',
        'partner_id',
        'title',
        'description',
        'price',
        'thumbnail',
        'status',
        'rejection_reason',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class, 'instructorID');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, 'partner_id');
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
        )->withPivot(['completion', 'completed', 'payment_status'])->withTimestamps();
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(CourseRating::class, 'courseID');
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