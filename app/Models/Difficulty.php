<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Difficulty extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'sorting_index'
    ];
    /**
     * Get the lessons that has this difficulty
     */
    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }
}
