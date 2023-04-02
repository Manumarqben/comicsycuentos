<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Obtain users related to this marker through the 'marker_user_work' table.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'marker_user_work');
    }

    /**
     * Obtain works related to this marker through the 'marker_user_work' table.
     */
    public function works()
    {
        return $this->belongsToMany(Work::class, 'marker_user_work');
    }
}
