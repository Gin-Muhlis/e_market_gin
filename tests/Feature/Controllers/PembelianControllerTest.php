<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Pembelian;

use App\Models\Pemasok;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembelianControllerTest extends TestCase
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
    public function it_displays_index_view_with_pembelians(): void
    {
        $pembelians = Pembelian::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('pembelians.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.pembelians.index')
            ->assertViewHas('pembelians');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_pembelian(): void
    {
        $response = $this->get(route('pembelians.create'));

        $response->assertOk()->assertViewIs('app.pembelians.create');
    }

    /**
     * @test
     */
    public function it_stores_the_pembelian(): void
    {
        $data = Pembelian::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('pembelians.store'), $data);

        $this->assertDatabaseHas('pembelians', $data);

        $pembelian = Pembelian::latest('id')->first();

        $response->assertRedirect(route('pembelians.edit', $pembelian));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $response = $this->get(route('pembelians.show', $pembelian));

        $response
            ->assertOk()
            ->assertViewIs('app.pembelians.show')
            ->assertViewHas('pembelian');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $response = $this->get(route('pembelians.edit', $pembelian));

        $response
            ->assertOk()
            ->assertViewIs('app.pembelians.edit')
            ->assertViewHas('pembelian');
    }

    /**
     * @test
     */
    public function it_updates_the_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $pemasok = Pemasok::factory()->create();
        $user = User::factory()->create();

        $data = [
            'kode_masuk' => $this->faker->text(50),
            'tanggal_masuk' => $this->faker->date(),
            'total' => $this->faker->randomNumber(2),
            'pemasok_id' => $pemasok->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('pembelians.update', $pembelian), $data);

        $data['id'] = $pembelian->id;

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertRedirect(route('pembelians.edit', $pembelian));
    }

    /**
     * @test
     */
    public function it_deletes_the_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $response = $this->delete(route('pembelians.destroy', $pembelian));

        $response->assertRedirect(route('pembelians.index'));

        $this->assertModelMissing($pembelian);
    }
}
