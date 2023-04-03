<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChapterImage extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'url',
        'order',
        'chapter_id',
    ];

    /**
     * Obtain chapter related to this image.
     */
    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
