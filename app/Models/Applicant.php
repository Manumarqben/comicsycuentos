<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'alias',
        'slug',
        'user_id',
        'created_at',
    ];
}
