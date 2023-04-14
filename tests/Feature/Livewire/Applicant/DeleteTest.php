<?php

namespace Tests\Feature\Livewire\Applicant;

use App\Http\Livewire\Applicant\Delete;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Delete::class);

        $component->assertStatus(200);
    }
}
