<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Penjualan;
use App\Models\DetailPenjualan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenjualanDetailPenjualansTest extends TestCase
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
    public function it_gets_penjualan_detail_penjualans(): void
    {
        $penjualan = Penjualan::factory()->create();
        $detailPenjualans = DetailPenjualan::factory()
            ->count(2)
            ->create([
                'penjualan_id' => $penjualan->id,
            ]);

        $response = $this->getJson(
            route('api.penjualans.detail-penjualans.index', $penjualan)
        );

        $response->assertOk()->assertSee($detailPenjualans[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_penjualan_detail_penjualans(): void
    {
        $penjualan = Penjualan::factory()->create();
        $data = DetailPenjualan::factory()
            ->make([
                'penjualan_id' => $penjualan->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.penjualans.detail-penjualans.store', $penjualan),
            $data
        );

        $this->assertDatabaseHas('detail_penjualans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $detailPenjualan = DetailPenjualan::latest('id')->first();

        $this->assertEquals($penjualan->id, $detailPenjualan->penjualan_id);
    }
}
