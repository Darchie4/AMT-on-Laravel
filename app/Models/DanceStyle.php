<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DanceStyle extends Model
{
    use HasFactory;

    /**
     * Get the lessons that has this DanceStyle
     */
    public function post(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class);
    }
}
