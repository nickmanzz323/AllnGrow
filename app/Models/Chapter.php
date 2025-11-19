<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_id',
        'title',
        'description',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    /**
     * Get the course that owns this chapter
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'courseID');
    }

    /**
     * Get all lessons in this chapter
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class)->orderBy('order');
    }

    /**
     * Get total duration of all lessons in this chapter
     */
    public function getTotalDurationAttribute(): int
    {
        return $this->lessons()->sum('duration') ?? 0;
    }

    /**
     * Get lessons count
     */
    public function getLessonsCountAttribute(): int
    {
        return $this->lessons()->count();
    }

    /**
     * Scope to order chapters
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }
}
