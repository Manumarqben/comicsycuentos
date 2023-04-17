<?php

namespace Tests\Feature\Livewire\Author;

use App\Http\Livewire\Author\UpdateAuthorInformationForm;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Validation\Rule;
use Livewire\Livewire;
use Tests\TestCase;

class UpdateAuthorInformationFormTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function the_component_can_render()
    {
        $this->actingAs($user = User::factory()->create());
        $author = Author::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('authors', ['alias' => $author->alias]);

        $component = Livewire::test(
            UpdateAuthorInformationForm::class,
            ['author' => $author]
        );

        $component->assertStatus(200);
    }

    /** @test */
    public function an_author_can_update_his_information()
    {
        $this->actingAs($user = User::factory()->create());
        $author = Author::factory()->create([
            'alias' => 'Author Example',
            'slug' => str('Author Example')->slug(),
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseHas('authors', ['alias' => $author->alias]);

        $component = Livewire::test(
            UpdateAuthorInformationForm::class,
            ['author' => $author]
        )
            ->set('author.alias', 'Alias Changed')
            ->assertSet('author.alias', 'Alias Changed')
            ->assertHasNoErrors([
                'author.alias' => [
                    'required',
                    'max:100',
                    'unique:applicants,alias',
                    Rule::unique('authors', 'alias')->ignore($author->id),
                ],
            ])
            ->set('author.biography', 'Biography Changed')
            ->assertSet('author.biography', 'Biography Changed')
            ->assertHasNoErrors([
                'author.biography' => [
                    'max:255',
                ],
            ])
            ->call('updateAuthorInformation');

        $this->assertDatabaseHas('authors', [
            'id' => $author->id,
            'alias' => 'Alias Changed',
            'biography' => 'Biography Changed',
        ]);
    }
}
