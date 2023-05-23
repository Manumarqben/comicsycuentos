<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'title',
        'type',
        'work_id',
    ];

    /**
     * Returns the work to which the instance belongs.
     */
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }

    /**
     * Get users related to this instance through the 'likes' table.
     */
    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }

    /**
     * Get all the images associated to the instance.
     */
    public function images(): HasMany
    {
        return $this->hasMany(ChapterImage::class);
    }

    /**
     * Get the text associated with the instance.
     */
    public function text(): HasOne
    {
        return $this->hasOne(ChapterText::class);
    }

    /**
     * Check if the chapter has a previous chapter
     */
    public function hasPreviousChapter(): bool
    {
        return $this->where('work_id', $this->work_id)
            ->where('number', '<', $this->number)
            ->exists();
    }

    /**
     * Check if there is a next chapter
     */
    public function hasNextChapter(): bool
    {
        return $this->where('work_id', $this->work_id)
            ->where('number', '>', $this->number)
            ->exists();
    }
}
