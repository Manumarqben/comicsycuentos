<?php

namespace Tests\Feature\Livewire\Work;

use App\Http\Livewire\Work\MarkerSelector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkerSelectorTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(MarkerSelector::class);

        $component->assertStatus(200);
    }
}
