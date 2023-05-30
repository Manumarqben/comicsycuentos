<?php

namespace App\Http\Livewire;

use App\Helpers\FilterHelper;
use Livewire\Component;

class Home extends Component
{
    public function redirectToWork($slug)
    {
        redirect()->route('work.show', $slug);
    }

    public function render()
    {
        $latestAggregatedWorks = FilterHelper::childrenFilter()->orderBy('created_at', 'desc')->take(12)->get();

        $worksInCarousel =  FilterHelper::childrenFilter()->inRandomOrder()->take(3)->get();

        return view('livewire.home', compact('worksInCarousel', 'latestAggregatedWorks'));
    }
}
