<?php

namespace Tests\Feature\Livewire\Work;

use App\Http\Livewire\Work\Save;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SaveTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Save::class);

        $component->assertStatus(200);
    }
}
