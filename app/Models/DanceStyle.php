<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DanceStyle extends Model
{
    use HasFactory;

    /**
     * Get the lessons that has this DanceStyle
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }
}
