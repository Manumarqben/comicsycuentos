<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use HasFactory;

    public $fillable = [
        'alias',
        'slug',
        'biography',
        'profile_photo_path',
        'user_id',
    ];

    /**
     * Return to the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all the works associated with this author.
     */
    public function works(): HasMany
    {
        return $this->hasMany(Work::class);
    }
}
