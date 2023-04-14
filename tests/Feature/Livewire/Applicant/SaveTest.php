<?php

namespace Tests\Feature\Livewire\Applicant;

use App\Http\Livewire\Applicant\Save;
use App\Models\Applicant;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class SaveTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Save::class);

        $component->assertStatus(200);
    }

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

    /** @test */
    public function a_user_cannot_use_alias_in_use()
    {
        $applicatorUser = User::factory()->create();
        $firstApplicant = Applicant::factory()->create([
            'alias' => 'Applicant Example',
            'slug' => str('Applicant Example')->slug(),
            'user_id' => $applicatorUser->id,
        ]);

        $this->assertDatabaseHas('applicants', ['alias' => $firstApplicant->alias]);

        $authorUser = User::factory()->create();
        $firstAuthor = Author::factory()->create([
            'alias' => 'Author Example',
            'slug' => str('Author Example')->slug(),
            'user_id' => $authorUser->id,
        ]);

        $this->assertDatabaseHas('authors', ['alias' => $firstAuthor->alias]);

        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(Save::class)
            // Comprobando que no puede usarse un alias de un aplicante.
            ->set('applicant.alias', $firstApplicant->alias)
            ->assertSet('applicant.alias', $firstApplicant->alias)
            ->call('submit')
            ->assertHasErrors([
                'applicant.alias' => [
                    'unique:applicants,alias',
                ],
                'applicant.slug' => [
                    'unique:applicants,slug',
                ],
            ])
            // Comprobando que no puede usarse un alias de un autor.
            ->set('applicant.alias', $firstAuthor->alias)
            ->assertSet('applicant.alias', $firstAuthor->alias)
            ->call('submit')
            ->assertHasErrors([
                'applicant.alias' => [
                    'unique:authors,alias',
                ],
                'applicant.slug' => [
                    'unique:authors,slug',
                ],
            ])
            // Comprobando que un alias libre si puede usarse  .
            ->set('applicant.alias', $this->faker->name)
            ->call('submit')
            ->assertHasNoErrors([
                'applicant.alias' => [
                    'unique:applicants,alias',
                    'unique:authors,alias',
                ],
                'applicant.slug' => [
                    'unique:applicants,slug',
                    'unique:authors,slug',
                ],
            ])
            ->assertDispatchedBrowserEvent('alert', [
                'message' => 'Application sent successfully'
            ]);

        $this->assertDatabaseHas('applicants', ['user_id' => $user->id]);
    }
}
