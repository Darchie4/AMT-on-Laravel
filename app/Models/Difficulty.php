<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Difficulty extends Model
{
    use HasFactory;

    /**
     * Get the lessons that has this difficulty
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
