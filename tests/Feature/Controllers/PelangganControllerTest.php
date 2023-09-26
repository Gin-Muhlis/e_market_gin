<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Pelanggan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PelangganControllerTest extends TestCase
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
    public function it_displays_index_view_with_pelanggans(): void
    {
        $pelanggans = Pelanggan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pelanggans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pelanggans.index')
            ->assertViewHas('pelanggans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pelanggan(): void
    {
        $response = $this->get(route('pelanggans.create'));

        $response->assertOk()->assertViewIs('app.pelanggans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pelanggan(): void
    {
        $data = Pelanggan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pelanggans.store'), $data);

        $this->assertDatabaseHas('pelanggans', $data);

        $pelanggan = Pelanggan::latest('id')->first();

        $response->assertRedirect(route('pelanggans.edit', $pelanggan));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->get(route('pelanggans.show', $pelanggan));

        $response
            ->assertOk()
            ->assertViewIs('app.pelanggans.show')
            ->assertViewHas('pelanggan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->get(route('pelanggans.edit', $pelanggan));

        $response
            ->assertOk()
            ->assertViewIs('app.pelanggans.edit')
            ->assertViewHas('pelanggan');
    }

    /**
     * @test
     */
    public function it_updates_the_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $data = [
            'kode_pelanggan' => $this->faker->text(50),
            'nama' => $this->faker->text(50),
            'alamat' => $this->faker->text(200),
            'no_telp' => $this->faker->text(20),
            'email' => $this->faker->unique->email(),
        ];

        $response = $this->put(route('pelanggans.update', $pelanggan), $data);

        $data['id'] = $pelanggan->id;

        $this->assertDatabaseHas('pelanggans', $data);

        $response->assertRedirect(route('pelanggans.edit', $pelanggan));
    }

    /**
     * @test
     */
    public function it_deletes_the_pelanggan(): void
    {
        $pelanggan = Pelanggan::factory()->create();

        $response = $this->delete(route('pelanggans.destroy', $pelanggan));

        $response->assertRedirect(route('pelanggans.index'));

        $this->assertModelMissing($pelanggan);
    }
}
