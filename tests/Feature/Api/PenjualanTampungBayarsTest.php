<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Penjualan;
use App\Models\TampungBayar;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenjualanTampungBayarsTest extends TestCase
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
    public function it_gets_penjualan_tampung_bayars(): void
    {
        $penjualan = Penjualan::factory()->create();
        $tampungBayars = TampungBayar::factory()
            ->count(2)
            ->create([
                'penjualan_id' => $penjualan->id,
            ]);

        $response = $this->getJson(
            route('api.penjualans.tampung-bayars.index', $penjualan)
        );

        $response->assertOk()->assertSee($tampungBayars[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_penjualan_tampung_bayars(): void
    {
        $penjualan = Penjualan::factory()->create();
        $data = TampungBayar::factory()
            ->make([
                'penjualan_id' => $penjualan->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.penjualans.tampung-bayars.store', $penjualan),
            $data
        );

        $this->assertDatabaseHas('tampung_bayars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $tampungBayar = TampungBayar::latest('id')->first();

        $this->assertEquals($penjualan->id, $tampungBayar->penjualan_id);
    }
}
