<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Pembelian;

use App\Models\Pemasok;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PembelianTest extends TestCase
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
    public function it_gets_pembelians_list(): void
    {
        $pembelians = Pembelian::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.pembelians.index'));

        $response->assertOk()->assertSee($pembelians[0]->kode_masuk);
    }

    /**
     * @test
     */
    public function it_stores_the_pembelian(): void
    {
        $data = Pembelian::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.pembelians.store'), $data);

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $pemasok = Pemasok::factory()->create();
        $user = User::factory()->create();

        $data = [
            'kode_masuk' => $this->faker->text(50),
            'tanggal_masuk' => $this->faker->date(),
            'total' => $this->faker->randomNumber(2),
            'pemasok_id' => $pemasok->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.pembelians.update', $pembelian),
            $data
        );

        $data['id'] = $pembelian->id;

        $this->assertDatabaseHas('pembelians', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_pembelian(): void
    {
        $pembelian = Pembelian::factory()->create();

        $response = $this->deleteJson(
            route('api.pembelians.destroy', $pembelian)
        );

        $this->assertModelMissing($pembelian);

        $response->assertNoContent();
    }
}
