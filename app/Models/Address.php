<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'street_number',
        'street_name',
        'zip_code',
        'city',
        'country',
    ];
    /**
     * Get all the locations at this address
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * Get all the users at this address
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function fullAddress()
    {
        return __('addressFormat', ['streetName' => $this->street_name, 'streetNumber' => $this->street_number, 'zipCode' => $this->zip_code,'city' => $this->city , 'country' => $this->country]);
    }
}
