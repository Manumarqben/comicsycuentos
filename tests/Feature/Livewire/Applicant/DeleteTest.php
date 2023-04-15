<?php

namespace Tests\Feature\Livewire\Applicant;

use App\Http\Livewire\Applicant\Delete;
use App\Models\Applicant;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    // /** @test */
    // public function the_component_can_render()
    // {
    //     $component = Livewire::test(Delete::class);

    //     $component->assertStatus(200);
    // }

    /** @test */
    public function a_user_can_withdraw_their_application_to_be_author()
    {
        $this->actingAs($user = User::factory()->create());

        $applicant = Applicant::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('applicants', ['id' => $applicant->id]);

        $component = Livewire::test(Delete::class, ['applicant' => $applicant])
            ->call('delete')
            ->assertDispatchedBrowserEvent('alert', [
                'message' => 'Application withdrawn',
            ]);

        $this->assertDatabaseMissing('applicants', ['id' => $applicant->id]);
    }
}
