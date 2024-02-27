<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;
    /**
     * Get the address of this location
     */
    public function address(): HasOne
    {
        return $this->hasOne(Address::class);
    }
}
