<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
     * Obtain the age.
     */
    public function age(): BelongsTo
    {
        return $this->belongsTo(Age::class);
    }


    /**
     * Obtain the state.
     */
    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    /**
     * Obtain the type.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Obtain the author.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Obtain genres related to this work.
     */
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    /**
     * Obtain users related to this work through the 'favorites' table.
     */
    public function usersFavorite(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    /**
     * Obtain users related to this work through the 'marker_user_work' table.
     */
    public function usersMarkers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'marker_user_work');
    }

    /**
     * Obtain markers related to this work through the 'marker_user_work' table.
     */
    public function markers(): BelongsToMany
    {
        return $this->belongsToMany(Marker::class, 'marker_user_work');
    }
}
