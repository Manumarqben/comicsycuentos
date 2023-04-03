<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Admin extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'user_id',
    ];

    /**
     * Returns the user to which the instance belongs.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
