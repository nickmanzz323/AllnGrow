<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentCourse extends Model
{
    use HasFactory;

    protected $table = 'student_course';

    protected $fillable = [
        'studentID',
        'courseID',
        'completion',
        'completed',
    ];

    protected $casts = [
        'completion' => 'integer', // 0-100
        'completed' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'studentID');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'courseID');
    }
}