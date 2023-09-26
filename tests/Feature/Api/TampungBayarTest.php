<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\TampungBayar;

use App\Models\Penjualan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TampungBayarTest extends TestCase
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
    public function it_gets_tampung_bayars_list(): void
    {
        $tampungBayars = TampungBayar::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.tampung-bayars.index'));

        $response->assertOk()->assertSee($tampungBayars[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_tampung_bayar(): void
    {
        $data = TampungBayar::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.tampung-bayars.store'), $data);

        $this->assertDatabaseHas('tampung_bayars', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.tampung-bayars.update', $tampungBayar),
            $data
        );

        $data['id'] = $tampungBayar->id;

        $this->assertDatabaseHas('tampung_bayars', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_tampung_bayar(): void
    {
        $tampungBayar = TampungBayar::factory()->create();

        $response = $this->deleteJson(
            route('api.tampung-bayars.destroy', $tampungBayar)
        );

        $this->assertModelMissing($tampungBayar);

        $response->assertNoContent();
    }
}
