<?php

namespace Tests\Feature\Livewire\Work;

use App\Http\Livewire\Work\MarkerSelector;
use App\Models\Marker;
use App\Models\User;
use App\Models\Work;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MarkerSelectorTest extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    /** @test */
    public function marker_selector_can_render()
    {
        $work = Work::factory()->create();

        $component = Livewire::test(MarkerSelector::class, ['id' => $work->id]);

        $component->assertStatus(200);
    }

    /** @test */
    public function a_user_can_add_a_work_to_their_library()
    {
        $this->actingAs($user = User::factory()->create());

        $work = Work::factory()->create();
        $marker = Marker::all()->random()->first();


        $component = Livewire::test(MarkerSelector::class, ['id' => $work->id])
            ->set('marker', $marker->slug);

        $this->assertTrue($user->works()->where('work_id', $work->id)->exists());
    }

    /** @test */
    public function a_user_can_delete_the_work_to_their_library()
    {
        $this->actingAs($user = User::factory()->create());

        $work = Work::factory()->create();
        $marker = Marker::all()->random()->first();
        $work->usersMarkers()->sync([$user->id => ['marker_id' => $marker->id]], false);

        $component = Livewire::test(MarkerSelector::class, ['id' => $work->id])
            ->set('marker', '');

        $this->assertNotTrue($user->works()->where('work_id', $work->id)->exists());
    }

    /** @test */
    public function a_user_can_change_the_marker_of_a_work()
    {
        $this->actingAs($user = User::factory()->create());

        $work = Work::factory()->create();
        $marker = Marker::inRandomOrder()->limit(2)->get();
        $work->usersMarkers()->sync([$user->id => ['marker_id' => $marker[0]->id]], false);

        $component = Livewire::test(MarkerSelector::class, ['id' => $work->id])
            ->set('marker', $marker[1]->slug);

        $this->assertDatabaseHas('marker_user_work', [
            'user_id' => $user->id,
            'work_id' => $work->id,
            'marker_id' => $marker[1]->id,
        ]);

        $this->assertDatabaseMissing('marker_user_work', [
            'user_id' => $user->id,
            'work_id' => $work->id,
            'marker_id' => $marker[0]->id,
        ]);
    }
}
