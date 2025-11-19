<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'course_id',
        'title',
        'description',
        'content',
        'video_url',
        'order',
        'duration',
        'is_free',
        'thumbnail',
        'fileUpload',
    ];

    protected $casts = [
        'order' => 'integer',
        'duration' => 'integer',
        'is_free' => 'boolean',
    ];

    /**
     * Get the chapter that owns this lesson
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    /**
     * Get the course that owns this lesson (through chapter)
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id', 'courseID');
    }

    /**
     * Get formatted duration (e.g., "5 min" or "1h 30min")
     */
    public function getFormattedDurationAttribute(): string
    {
        if (!$this->duration) {
            return '-';
        }

        if ($this->duration < 60) {
            return $this->duration . ' min';
        }

        $hours = floor($this->duration / 60);
        $minutes = $this->duration % 60;

        if ($minutes === 0) {
            return $hours . 'h';
        }

        return $hours . 'h ' . $minutes . 'min';
    }

    /**
     * Scope to order lessons
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    /**
     * Scope to get free preview lessons
     */
    public function scopeFreePreview($query)
    {
        return $query->where('is_free', true);
    }
}
