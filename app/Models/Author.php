<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public $timestamps = false;

    use HasFactory;

    protected $fillable = [
        'alias',
        'biography',
        'profile_photo_path',
        'user_id',
    ];

    public function works() 
    {
        return $this->hasMany(Work::class);
    }
}