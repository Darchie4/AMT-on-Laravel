<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
        'total_signup_space',
        'can_signup',
        'visible',
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
        return $this->hasManyThrough(Location::class, LessonTimeLocation::class);
    }

    /**
     * Get all the Teachers for the lesson.
     */
    public function instructors(): BelongsToMany
    {
        return $this->belongsToMany(InstructorInfo::class);
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

    /**
     * Get the Registrations of the lesson
     */
    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }

    public function canSignup(): bool
    {
     return ($this->can_signup);
    }

    public function canSignupUser(User $user): bool
    {
        $date = Carbon::parse($user->birthday);
        $yearsSinceDate = $date->diffInYears(Carbon::now());
        return ($this->canSignup() && $this->age_min <= $yearsSinceDate && $this->age_max >= $yearsSinceDate);
    }
}
