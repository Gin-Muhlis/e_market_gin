<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\TampungBayar;

use App\Models\Penjualan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TampungBayarControllerTest extends TestCase
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
    public function it_displays_index_view_with_tampung_bayars(): void
    {
        $tampungBayars = TampungBayar::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('tampung-bayars.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.tampung_bayars.index')
            ->assertViewHas('tampungBayars');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_tampung_bayar(): void
    {
        $response = $this->get(route('tampung-bayars.create'));

        $response->assertOk()->assertViewIs('app.tampung_bayars.create');
    }

    /**
     * @test
     */
    public function it_stores_the_tampung_bayar(): void
    {
        $data = TampungBayar::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('tampung-bayars.store'), $data);

        $this->assertDatabaseHas('tampung_bayars', $data);

        $tampungBayar = TampungBayar::latest('id')->first();

        $response->assertRedirect(route('tampung-bayars.edit', $tampungBayar));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_tampung_bayar(): void
    {
        $tampungBayar = TampungBayar::factory()->create();

        $response = $this->get(route('tampung-bayars.show', $tampungBayar));

        $response
            ->assertOk()
            ->assertViewIs('app.tampung_bayars.show')
            ->assertViewHas('tampungBayar');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_tampung_bayar(): void
    {
        $tampungBayar = TampungBayar::factory()->create();

        $response = $this->get(route('tampung-bayars.edit', $tampungBayar));

        $response
            ->assertOk()
            ->assertViewIs('app.tampung_bayars.edit')
            ->assertViewHas('tampungBayar');
    }

    /**
     * @test
     */
    public function it_updates_the_tampung_bayar(): void
    {
        $tampungBayar = TampungBayar::factory()->create();

        $penjualan = Penjualan::factory()->create();

        $data = [
            'total' => $this->faker->randomNumber(2),
            'terima' => $this->faker->randomNumber(2),
            'kembali' => $this->faker->randomNumber(2),
            'penjualan_id' => $penjualan->id,
        ];

        $response = $this->put(
            route('tampung-bayars.update', $tampungBayar),
            $data
        );

        $data['id'] = $tampungBayar->id;

        $this->assertDatabaseHas('tampung_bayars', $data);

        $response->assertRedirect(route('tampung-bayars.edit', $tampungBayar));
    }

    /**
     * @test
     */
    public function it_deletes_the_tampung_bayar(): void
    {
        $tampungBayar = TampungBayar::factory()->create();

        $response = $this->delete(
            route('tampung-bayars.destroy', $tampungBayar)
        );

        $response->assertRedirect(route('tampung-bayars.index'));

        $this->assertModelMissing($tampungBayar);
    }
}
