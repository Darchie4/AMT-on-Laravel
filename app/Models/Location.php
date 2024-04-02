<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'long_description',
        'short_description',
        'cover_img_path',
        'address_id'
    ];
    /**
     * Get the address of this location
     */
    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
