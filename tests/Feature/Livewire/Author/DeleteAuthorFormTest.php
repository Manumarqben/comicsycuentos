<?php

namespace Tests\Feature\Livewire\Author;

use App\Http\Livewire\Author\DeleteAuthorForm;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAuthorFormTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(DeleteAuthorForm::class);

        $component->assertStatus(200);
    }
}
