<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'front_page',
        'age_id',
        'author_id',
        'state_id',
        'type_id',
    ];
}
