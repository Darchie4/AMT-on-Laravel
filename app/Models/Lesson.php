<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'short_description',
        'long_description',
        'season_start',
        'season_end',
        'age_min',
        'age_max',
        'price',
        'cover_img_path',
        'dance_style_id',
        'difficulty_id',
    ];

    /**
     * Get the location(s) and time(s) of the lesson
     */
    public function lessonTimeLocations(): HasMany
    {
        return $this->hasMany(LessonTimeLocation::class);
    }

    /**
     * Get all the locations for the lesson.
     */
    public function locations(): HasManyThrough
    {
        return $this->hasManyThrough(Location::class, 'lesson_time_locations');
    }

    /**
     * Get all the Teachers for the lesson.
     */
    public function instructors(): HasManyThrough
    {
        return $this->hasManyThrough(InstructorInfo::class, InstructorInfoLesson::class, 'lesson_id', 'id', 'id', 'instructor_info_id');
    }

    /**
     * Get the DanceStyle of the lesson
     */
    public function danceStyle(): BelongsTo
    {
        return $this->belongsTo(DanceStyle::class);
    }

    /**
     * Get the Difficulty of the lesson
     */
    public function difficulty(): BelongsTo
    {
        return $this->belongsTo(Difficulty::class);
    }
}
