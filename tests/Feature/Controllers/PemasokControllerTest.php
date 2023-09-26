<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Pemasok;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PemasokControllerTest extends TestCase
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
    public function it_displays_index_view_with_pemasoks(): void
    {
        $pemasoks = Pemasok::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pemasoks.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pemasoks.index')
            ->assertViewHas('pemasoks');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pemasok(): void
    {
        $response = $this->get(route('pemasoks.create'));

        $response->assertOk()->assertViewIs('app.pemasoks.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pemasok(): void
    {
        $data = Pemasok::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pemasoks.store'), $data);

        $this->assertDatabaseHas('pemasoks', $data);

        $pemasok = Pemasok::latest('id')->first();

        $response->assertRedirect(route('pemasoks.edit', $pemasok));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pemasok(): void
    {
        $pemasok = Pemasok::factory()->create();

        $response = $this->get(route('pemasoks.show', $pemasok));

        $response
            ->assertOk()
            ->assertViewIs('app.pemasoks.show')
            ->assertViewHas('pemasok');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pemasok(): void
    {
        $pemasok = Pemasok::factory()->create();

        $response = $this->get(route('pemasoks.edit', $pemasok));

        $response
            ->assertOk()
            ->assertViewIs('app.pemasoks.edit')
            ->assertViewHas('pemasok');
    }

    /**
     * @test
     */
    public function it_updates_the_pemasok(): void
    {
        $pemasok = Pemasok::factory()->create();

        $data = [
            'nama_pemasok' => $this->faker->text(50),
        ];

        $response = $this->put(route('pemasoks.update', $pemasok), $data);

        $data['id'] = $pemasok->id;

        $this->assertDatabaseHas('pemasoks', $data);

        $response->assertRedirect(route('pemasoks.edit', $pemasok));
    }

    /**
     * @test
     */
    public function it_deletes_the_pemasok(): void
    {
        $pemasok = Pemasok::factory()->create();

        $response = $this->delete(route('pemasoks.destroy', $pemasok));

        $response->assertRedirect(route('pemasoks.index'));

        $this->assertModelMissing($pemasok);
    }
}
