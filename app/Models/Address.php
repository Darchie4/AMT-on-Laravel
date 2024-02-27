<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    /**
     * Get all the locations at this address
     */
    public function locations(): BelongsToMany
    {
        return $this->belongsToMany(Location::class);
    }

    /**
     * Get all the users at this address
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
