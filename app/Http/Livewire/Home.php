<?php

namespace App\Http\Livewire;

use App\Helpers\FilterHelper;
use Livewire\Component;

class Home extends Component
{
    public function render()
    {
        $works = FilterHelper::childrenFilter();

        $worksInCarousel =  $works->inRandomOrder()->take(3)->get();

        $latestAggregatedWorks = $works->orderBy('created_at', 'desc')->take(12)->get();

        return view('livewire.home', compact('worksInCarousel', 'latestAggregatedWorks'));
    }
}
