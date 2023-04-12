<?php

namespace Tests\Feature\Livewire\Work;

use App\Http\Livewire\Work\FavoriteButton;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class FavoriteButtonTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /** @test */
    public function favorite_button_can_render()
    {
        $work = Work::factory()->create();

        $component = Livewire::test(FavoriteButton::class, ['id' => $work->id]);

        $component->assertStatus(200);
    }

    /** @test */
    public function a_user_can_mark_a_work_as_favorite()
    {
        $work = Work::factory()->create();

        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(FavoriteButton::class, ['id' => $work->id])
            ->call('fav');

        $this->assertTrue($user->favorites()->where('work_id', $work->id)->exists());
    }

    /** @test */
    public function a_user_can_unmark_a_work_as_favorite()
    {
        $user = User::factory()->create();
        $work = Work::factory()->create();

        $user->favorites()->attach($work);

        Livewire::actingAs($user);

        $component = Livewire::test(FavoriteButton::class, ['id' => $work->id])
            ->call('fav');

        $this->assertNotTrue($user->favorites()->where('work_id', $work->id)->exists());
    }
}
