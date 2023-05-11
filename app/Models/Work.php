<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'synopsis',
        'front_page',
        'age_id',
        'state_id',
        'type_id',
        'author_id',
    ];

    /**
     * Returns the age to which the instance belongs.
     */
    public function age(): BelongsTo
    {
        return $this->belongsTo(Age::class);
    }


    /**
     * Returns the state to which the instance belongs.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Returns the type to which the instance belongs.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Returns the author to which the instance belongs.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get genres related to this instance.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Get users related to this instance through the 'favorites' table.
     */
    public function usersFavorite(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Get users related to this instance through the 'marker_user_work' table.
     */
    public function usersMarkers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'marker_user_work');
    }

    /**
     * Get markers related to this instance through the 'marker_user_work' table.
     */
    public function markers(): BelongsToMany
    {
        return $this->belongsToMany(Marker::class, 'marker_user_work');
    }

    /**
     * Get all the chapters associated to the instance.
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }

    public function bookmarks(): BelongsToMany
    {
        return $this->belongsToMany(Chapter::class, 'bookmarks');
    }

    public function userBookmark()
    {
        return $this->bookmarks()->where('user_id', auth()->user()->id)->first();
    }
}
