<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InstructorInfo extends Model
{
    use HasFactory;

    /**
     * Get the user that the instructor information belongs to.
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
