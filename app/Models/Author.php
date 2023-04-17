<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Author extends Model
{
    use HasFactory;

    public $fillable = [
        'alias',
        'slug',
        'biography',
        'user_id',
    ];

    /**
     * Returns the user to which the instance belongs.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the works associated to the instance.
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }

    /**
     * Get the photo associated with the instance.
     */
    public function profilePhoto(): HasOne
    {
        return $this->hasOne(AuthorProfilePhotos::class);
    }
}
