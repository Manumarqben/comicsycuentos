<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Models\Work;

class FilterHelper
{
    public static function childrenFilter()
    {
        if (auth()->check()) {
            $age = Carbon::parse(auth()->user()->birthdate)->age;
            if ($age >= 18) {
                return Work::query();
            }
        }
        return Work::whereHas('age', function ($query) {
            $query->where('year', '<', 18);
        });
    }
}
