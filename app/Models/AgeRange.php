<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgeRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'age_min',
        'age_max',
    ];

    /**
     * Returns the age to which the instance belongs.
     */
    public function minAge(): BelongsTo
    {
        return $this->belongsTo(Age::class, 'age_min');
    }

    /**
     * Returns the age to which the instance belongs.
     */
    public function maxAge(): BelongsTo
    {
        return $this->belongsTo(Age::class, 'age_max');
    }
}
