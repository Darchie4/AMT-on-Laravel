<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InstructorInfo extends Model
{
    use HasFactory;

    /**
     * Get the user that the instructor information belongs to.
     */
    public function phone(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
