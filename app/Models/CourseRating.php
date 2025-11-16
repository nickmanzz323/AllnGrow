<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CourseRating extends Model
{
    use HasFactory;

    protected $table = 'course_rating';

    protected $fillable = [
        'courseID',
        'studentID',
        'rating',
        'review',
    ];

    protected $casts = [
        'rating' => 'integer',
        'created_at' => 'datetime',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'courseID');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID');
    }
}