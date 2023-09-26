<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DetailTransaksi;

use App\Models\Transaksi;
use App\Models\JenisPembayaran;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailTransaksiControllerTest extends TestCase
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
    public function it_displays_index_view_with_detail_transaksis(): void
    {
        $detailTransaksis = DetailTransaksi::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('detail-transaksis.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.detail_transaksis.index')
            ->assertViewHas('detailTransaksis');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_detail_transaksi(): void
    {
        $response = $this->get(route('detail-transaksis.create'));

        $response->assertOk()->assertViewIs('app.detail_transaksis.create');
    }

    /**
     * @test
     */
    public function it_stores_the_detail_transaksi(): void
    {
        $data = DetailTransaksi::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('detail-transaksis.store'), $data);

        $this->assertDatabaseHas('detail_transaksis', $data);

        $detailTransaksi = DetailTransaksi::latest('id')->first();

        $response->assertRedirect(
            route('detail-transaksis.edit', $detailTransaksi)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_detail_transaksi(): void
    {
        $detailTransaksi = DetailTransaksi::factory()->create();

        $response = $this->get(
            route('detail-transaksis.show', $detailTransaksi)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_transaksis.show')
            ->assertViewHas('detailTransaksi');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_detail_transaksi(): void
    {
        $detailTransaksi = DetailTransaksi::factory()->create();

        $response = $this->get(
            route('detail-transaksis.edit', $detailTransaksi)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.detail_transaksis.edit')
            ->assertViewHas('detailTransaksi');
    }

    /**
     * @test
     */
    public function it_updates_the_detail_transaksi(): void
    {
        $detailTransaksi = DetailTransaksi::factory()->create();

        $transaksi = Transaksi::factory()->create();
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $data = [
            'jumlah_bayar' => $this->faker->randomNumber(2),
            'transaksi_id' => $transaksi->id,
            'jenis_pembayaran_id' => $jenisPembayaran->id,
        ];

        $response = $this->put(
            route('detail-transaksis.update', $detailTransaksi),
            $data
        );

        $data['id'] = $detailTransaksi->id;

        $this->assertDatabaseHas('detail_transaksis', $data);

        $response->assertRedirect(
            route('detail-transaksis.edit', $detailTransaksi)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_detail_transaksi(): void
    {
        $detailTransaksi = DetailTransaksi::factory()->create();

        $response = $this->delete(
            route('detail-transaksis.destroy', $detailTransaksi)
        );

        $response->assertRedirect(route('detail-transaksis.index'));

        $this->assertModelMissing($detailTransaksi);
    }
}
