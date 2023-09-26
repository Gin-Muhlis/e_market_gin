<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Transaksi;

use App\Models\Rombel;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransaksiTest extends TestCase
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
    public function it_gets_transaksis_list(): void
    {
        $transaksis = Transaksi::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.transaksis.index'));

        $response->assertOk()->assertSee($transaksis[0]->kode_transaksi);
    }

    /**
     * @test
     */
    public function it_stores_the_transaksi(): void
    {
        $data = Transaksi::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.transaksis.store'), $data);

        $this->assertDatabaseHas('transaksis', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_transaksi(): void
    {
        $transaksi = Transaksi::factory()->create();

        $rombel = Rombel::factory()->create();

        $data = [
            'kode_transaksi' => $this->faker->text(255),
            'tgl_bayar' => $this->faker->date(),
            'user_input' => $this->faker->text(255),
            'rombel_id' => $rombel->id,
        ];

        $response = $this->putJson(
            route('api.transaksis.update', $transaksi),
            $data
        );

        $data['id'] = $transaksi->id;

        $this->assertDatabaseHas('transaksis', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_transaksi(): void
    {
        $transaksi = Transaksi::factory()->create();

        $response = $this->deleteJson(
            route('api.transaksis.destroy', $transaksi)
        );

        $this->assertModelMissing($transaksi);

        $response->assertNoContent();
    }
}
