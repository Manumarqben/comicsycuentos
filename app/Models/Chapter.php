<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'title',
        'work_id',
    ];

    /**
     * Return the work.
     */
    public function work(): BelongsTo
    {
        return $this->belongsTo(Work::class);
    }
}
