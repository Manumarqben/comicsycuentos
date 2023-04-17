<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AuthorProfilePhotos extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'author_id',
        'path'
    ];

    /**
     * Returns the user to which the instance belongs.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
