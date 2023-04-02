<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'title',
        'work_id',
    ];

    public function work()
    {
        return $this->belongsTo(Work::class);
    }
}
