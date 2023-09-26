<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Rombel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RombelControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_rombels(): void
    {
        $rombels = Rombel::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('rombels.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.rombels.index')
            ->assertViewHas('rombels');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_rombel(): void
    {
        $response = $this->get(route('rombels.create'));

        $response->assertOk()->assertViewIs('app.rombels.create');
    }

    /**
     * @test
     */
    public function it_stores_the_rombel(): void
    {
        $data = Rombel::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('rombels.store'), $data);

        $this->assertDatabaseHas('rombels', $data);

        $rombel = Rombel::latest('id')->first();

        $response->assertRedirect(route('rombels.edit', $rombel));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_rombel(): void
    {
        $rombel = Rombel::factory()->create();

        $response = $this->get(route('rombels.show', $rombel));

        $response
            ->assertOk()
            ->assertViewIs('app.rombels.show')
            ->assertViewHas('rombel');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_rombel(): void
    {
        $rombel = Rombel::factory()->create();

        $response = $this->get(route('rombels.edit', $rombel));

        $response
            ->assertOk()
            ->assertViewIs('app.rombels.edit')
            ->assertViewHas('rombel');
    }

    /**
     * @test
     */
    public function it_updates_the_rombel(): void
    {
        $rombel = Rombel::factory()->create();

        $data = [
            'rombel' => $this->faker->text(255),
        ];

        $response = $this->put(route('rombels.update', $rombel), $data);

        $data['id'] = $rombel->id;

        $this->assertDatabaseHas('rombels', $data);

        $response->assertRedirect(route('rombels.edit', $rombel));
    }

    /**
     * @test
     */
    public function it_deletes_the_rombel(): void
    {
        $rombel = Rombel::factory()->create();

        $response = $this->delete(route('rombels.destroy', $rombel));

        $response->assertRedirect(route('rombels.index'));

        $this->assertModelMissing($rombel);
    }
}
