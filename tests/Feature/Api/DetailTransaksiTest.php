<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DetailTransaksi;

use App\Models\Transaksi;
use App\Models\JenisPembayaran;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DetailTransaksiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_detail_transaksis_list(): void
    {
        $detailTransaksis = DetailTransaksi::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.detail-transaksis.index'));

        $response->assertOk()->assertSee($detailTransaksis[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_detail_transaksi(): void
    {
        $data = DetailTransaksi::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.detail-transaksis.store'),
            $data
        );

        $this->assertDatabaseHas('detail_transaksis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.detail-transaksis.update', $detailTransaksi),
            $data
        );

        $data['id'] = $detailTransaksi->id;

        $this->assertDatabaseHas('detail_transaksis', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_detail_transaksi(): void
    {
        $detailTransaksi = DetailTransaksi::factory()->create();

        $response = $this->deleteJson(
            route('api.detail-transaksis.destroy', $detailTransaksi)
        );

        $this->assertModelMissing($detailTransaksi);

        $response->assertNoContent();
    }
}
