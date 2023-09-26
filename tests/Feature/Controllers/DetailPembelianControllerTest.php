<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DetailPembelian;

use App\Models\Barang;
use App\Models\Pembelian;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailPembelianControllerTest extends TestCase
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
    public function it_displays_index_view_with_detail_pembelians(): void
    {
        $detailPembelians = DetailPembelian::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('detail-pembelians.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.detail_pembelians.index')
            ->assertViewHas('detailPembelians');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_detail_pembelian(): void
    {
        $response = $this->get(route('detail-pembelians.create'));

        $response->assertOk()->assertViewIs('app.detail_pembelians.create');
    }

    /**
     * @test
     */
    public function it_stores_the_detail_pembelian(): void
    {
        $data = DetailPembelian::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('detail-pembelians.store'), $data);

        $this->assertDatabaseHas('detail_pembelians', $data);

        $detailPembelian = DetailPembelian::latest('id')->first();

        $response->assertRedirect(
            route('detail-pembelians.edit', $detailPembelian)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_detail_pembelian(): void
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $response = $this->get(
            route('detail-pembelians.show', $detailPembelian)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_pembelians.show')
            ->assertViewHas('detailPembelian');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_detail_pembelian(): void
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $response = $this->get(
            route('detail-pembelians.edit', $detailPembelian)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_pembelians.edit')
            ->assertViewHas('detailPembelian');
    }

    /**
     * @test
     */
    public function it_updates_the_detail_pembelian(): void
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $pembelian = Pembelian::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'harga_beli' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'pembelian_id' => $pembelian->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->put(
            route('detail-pembelians.update', $detailPembelian),
            $data
        );

        $data['id'] = $detailPembelian->id;

        $this->assertDatabaseHas('detail_pembelians', $data);

        $response->assertRedirect(
            route('detail-pembelians.edit', $detailPembelian)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_detail_pembelian(): void
    {
        $detailPembelian = DetailPembelian::factory()->create();

        $response = $this->delete(
            route('detail-pembelians.destroy', $detailPembelian)
        );

        $response->assertRedirect(route('detail-pembelians.index'));

        $this->assertModelMissing($detailPembelian);
    }
}
