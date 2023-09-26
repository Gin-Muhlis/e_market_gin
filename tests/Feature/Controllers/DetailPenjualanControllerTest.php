<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DetailPenjualan;

use App\Models\Barang;
use App\Models\Penjualan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailPenjualanControllerTest extends TestCase
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
    public function it_displays_index_view_with_detail_penjualans(): void
    {
        $detailPenjualans = DetailPenjualan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('detail-penjualans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.detail_penjualans.index')
            ->assertViewHas('detailPenjualans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_detail_penjualan(): void
    {
        $response = $this->get(route('detail-penjualans.create'));

        $response->assertOk()->assertViewIs('app.detail_penjualans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_detail_penjualan(): void
    {
        $data = DetailPenjualan::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('detail-penjualans.store'), $data);

        $this->assertDatabaseHas('detail_penjualans', $data);

        $detailPenjualan = DetailPenjualan::latest('id')->first();

        $response->assertRedirect(
            route('detail-penjualans.edit', $detailPenjualan)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_detail_penjualan(): void
    {
        $detailPenjualan = DetailPenjualan::factory()->create();

        $response = $this->get(
            route('detail-penjualans.show', $detailPenjualan)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_penjualans.show')
            ->assertViewHas('detailPenjualan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_detail_penjualan(): void
    {
        $detailPenjualan = DetailPenjualan::factory()->create();

        $response = $this->get(
            route('detail-penjualans.edit', $detailPenjualan)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_penjualans.edit')
            ->assertViewHas('detailPenjualan');
    }

    /**
     * @test
     */
    public function it_updates_the_detail_penjualan(): void
    {
        $detailPenjualan = DetailPenjualan::factory()->create();

        $penjualan = Penjualan::factory()->create();
        $barang = Barang::factory()->create();

        $data = [
            'harga_jual' => $this->faker->randomNumber(2),
            'jumlah' => $this->faker->randomNumber(0),
            'sub_total' => $this->faker->randomNumber(2),
            'penjualan_id' => $penjualan->id,
            'barang_id' => $barang->id,
        ];

        $response = $this->put(
            route('detail-penjualans.update', $detailPenjualan),
            $data
        );

        $data['id'] = $detailPenjualan->id;

        $this->assertDatabaseHas('detail_penjualans', $data);

        $response->assertRedirect(
            route('detail-penjualans.edit', $detailPenjualan)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_detail_penjualan(): void
    {
        $detailPenjualan = DetailPenjualan::factory()->create();

        $response = $this->delete(
            route('detail-penjualans.destroy', $detailPenjualan)
        );

        $response->assertRedirect(route('detail-penjualans.index'));

        $this->assertModelMissing($detailPenjualan);
    }
}
