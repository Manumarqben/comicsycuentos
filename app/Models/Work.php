<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
}
