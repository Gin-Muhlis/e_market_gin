<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Penjualan;

use App\Models\Pelanggan;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PenjualanTest extends TestCase
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
    public function it_gets_penjualans_list(): void
    {
        $penjualans = Penjualan::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.penjualans.index'));

        $response->assertOk()->assertSee($penjualans[0]->no_faktur);
    }

    /**
     * @test
     */
    public function it_stores_the_penjualan(): void
    {
        $data = Penjualan::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.penjualans.store'), $data);

        $this->assertDatabaseHas('penjualans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_penjualan(): void
    {
        $penjualan = Penjualan::factory()->create();

        $pelanggan = Pelanggan::factory()->create();
        $user = User::factory()->create();

        $data = [
            'no_faktur' => $this->faker->text(50),
            'tgl_faktur' => $this->faker->date(),
            'total_bayar' => $this->faker->randomNumber(2),
            'pelanggan_id' => $pelanggan->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.penjualans.update', $penjualan),
            $data
        );

        $data['id'] = $penjualan->id;

        $this->assertDatabaseHas('penjualans', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_penjualan(): void
    {
        $penjualan = Penjualan::factory()->create();

        $response = $this->deleteJson(
            route('api.penjualans.destroy', $penjualan)
        );

        $this->assertModelMissing($penjualan);

        $response->assertNoContent();
    }
}
