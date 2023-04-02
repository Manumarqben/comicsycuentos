<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'slug',
        'user_id',
    ];

    /**
     * Return to the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
