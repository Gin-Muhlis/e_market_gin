<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiDetailTransaksisTest extends TestCase
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
    public function it_gets_transaksi_detail_transaksis(): void
    {
        $transaksi = Transaksi::factory()->create();
        $detailTransaksis = DetailTransaksi::factory()
            ->count(2)
            ->create([
                'transaksi_id' => $transaksi->id,
            ]);

        $response = $this->getJson(
            route('api.transaksis.detail-transaksis.index', $transaksi)
        );

        $response->assertOk()->assertSee($detailTransaksis[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_transaksi_detail_transaksis(): void
    {
        $transaksi = Transaksi::factory()->create();
        $data = DetailTransaksi::factory()
            ->make([
                'transaksi_id' => $transaksi->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.transaksis.detail-transaksis.store', $transaksi),
            $data
        );

        $this->assertDatabaseHas('detail_transaksis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $detailTransaksi = DetailTransaksi::latest('id')->first();

        $this->assertEquals($transaksi->id, $detailTransaksi->transaksi_id);
    }
}
