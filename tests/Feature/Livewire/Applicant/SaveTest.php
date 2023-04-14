<?php

namespace Tests\Feature\Livewire\Applicant;

use App\Http\Livewire\Applicant\Save;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SaveTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // public function the_component_can_render()
    // {
    //     $component = Livewire::test(Save::class);

    //     $component->assertStatus(200);
    // }

    /** @test */
    public function a_user_can_apply_to_be_author()
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(Save::class)
            ->call('submit')
            ->assertDispatchedBrowserEvent('alert', [
                'message' => 'Application sent successfully'
            ]);

        $this->assertDatabaseHas('applicants', ['user_id' => $user->id]);
    }
}
