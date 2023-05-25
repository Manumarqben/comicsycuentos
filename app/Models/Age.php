<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Age extends Model
{
    use HasFactory;

    protected $fillable = [
        'year',
        'description',
    ];

    /**
     * Get all the works associated to the instance.
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    /**
     * Get all the ranges associated to the instance.
     */
    public function minAgeRanges(): HasMany
    {
        return $this->hasMany(AgeRange::class, 'age_min');
    }

    /**
     * Get all the ranges associated to the instance.
     */
    public function maxAgeRanges(): HasMany
    {
        return $this->hasMany(AgeRange::class, 'age_max');
    }
}
