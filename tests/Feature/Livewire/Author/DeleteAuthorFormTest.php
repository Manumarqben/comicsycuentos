<?php

namespace Tests\Feature\Livewire\Author;

use App\Http\Livewire\Author\DeleteAuthorForm;
use App\Models\Author;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DeleteAuthorFormTest extends TestCase
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
            DeleteAuthorForm::class,
            ['author' => $author]
        );

        $component->assertStatus(200);
    }

    /** @test */
    public function a_user_can_delete_your_author_information()
    {
        $this->actingAs($user = User::factory()->create());
        $author = Author::factory()->create([
            'user_id' => $user->id
        ]);

        $this->assertDatabaseHas('authors', ['alias' => $author->alias]);

        $component = Livewire::test(
            DeleteAuthorForm::class,
            ['author' => $author]
        )
            ->call('delete');

        $this->assertDatabaseMissing('authors', ['alias' => $author->alias]);
    }

    /** @test */
    public function a_user_cannot_erase_another_author_who_is_not_yours()
    {
        $anotherUser = User::factory()->create();
        $author = Author::factory()->create([
            'user_id' => $anotherUser->id
        ]);

        $this->assertDatabaseHas('authors', ['alias' => $author->alias]);

        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(
            DeleteAuthorForm::class,
            ['author' => $author]
        )
            ->call('delete');

        $this->assertDatabaseHas('authors', ['alias' => $author->alias]);
    }
}
