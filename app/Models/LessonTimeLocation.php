<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class LessonTimeLocation extends Model
{
    use HasFactory;

    /**
     * Get the lesson
     */
    public function phone(): HasOne
    {
        return $this->hasOne(Lesson::class);
    }

    /**
     * Get the lesson
     */
    public function location(): HasOne
    {
        return $this->hasOne(Location::class);
    }
}
