<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Lesson extends Model
{
    use HasFactory;

    /**
     * Get the location(s) and time(s) of the lesson
     */
    public function lessonTimeLocation(): HasMany
    {
        return $this->hasMany(LessonTimeLocation::class);
    }

    /**
     * Get all the deployments for the project.
     */
    public function locations(): HasManyThrough
    {
        return $this->hasManyThrough(Location::class, 'lesson_time_locations', '');
    }

}
