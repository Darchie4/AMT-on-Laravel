<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PricingStructure extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'payment_frequency',
        'frequency_multiplier',
    ];


    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }
}
