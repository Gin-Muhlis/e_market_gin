<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pembelian;
use App\Models\DetailPembelian;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembelianDetailPembeliansTest extends TestCase
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
    public function it_gets_pembelian_detail_pembelians(): void
    {
        $pembelian = Pembelian::factory()->create();
        $detailPembelians = DetailPembelian::factory()
            ->count(2)
            ->create([
                'pembelian_id' => $pembelian->id,
            ]);

        $response = $this->getJson(
            route('api.pembelians.detail-pembelians.index', $pembelian)
        );

        $response->assertOk()->assertSee($detailPembelians[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_pembelian_detail_pembelians(): void
    {
        $pembelian = Pembelian::factory()->create();
        $data = DetailPembelian::factory()
            ->make([
                'pembelian_id' => $pembelian->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.pembelians.detail-pembelians.store', $pembelian),
            $data
        );

        $this->assertDatabaseHas('detail_pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $detailPembelian = DetailPembelian::latest('id')->first();

        $this->assertEquals($pembelian->id, $detailPembelian->pembelian_id);
    }
}
