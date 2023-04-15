<?php

namespace Tests\Feature\Livewire\Author;

use App\Http\Livewire\Author\UpdateAuthorInformationForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAuthorInformationFormTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(UpdateAuthorInformationForm::class);

        $component->assertStatus(200);
    }
}
