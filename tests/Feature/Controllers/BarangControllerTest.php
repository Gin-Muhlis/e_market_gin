<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Barang;

use App\Models\Produk;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BarangControllerTest extends TestCase
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
    public function it_displays_index_view_with_barangs(): void
    {
        $barangs = Barang::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('barangs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.barangs.index')
            ->assertViewHas('barangs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_barang(): void
    {
        $response = $this->get(route('barangs.create'));

        $response->assertOk()->assertViewIs('app.barangs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_barang(): void
    {
        $data = Barang::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('barangs.store'), $data);

        $this->assertDatabaseHas('barangs', $data);

        $barang = Barang::latest('id')->first();

        $response->assertRedirect(route('barangs.edit', $barang));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_barang(): void
    {
        $barang = Barang::factory()->create();

        $response = $this->get(route('barangs.show', $barang));

        $response
            ->assertOk()
            ->assertViewIs('app.barangs.show')
            ->assertViewHas('barang');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_barang(): void
    {
        $barang = Barang::factory()->create();

        $response = $this->get(route('barangs.edit', $barang));

        $response
            ->assertOk()
            ->assertViewIs('app.barangs.edit')
            ->assertViewHas('barang');
    }

    /**
     * @test
     */
    public function it_updates_the_barang(): void
    {
        $barang = Barang::factory()->create();

        $user = User::factory()->create();
        $produk = Produk::factory()->create();

        $data = [
            'kode_barang' => $this->faker->text(50),
            'nama_barang' => $this->faker->text(100),
            'satuan' => $this->faker->text(10),
            'harga_jual' => $this->faker->randomNumber(2),
            'stok' => $this->faker->randomNumber(0),
            'ditarik' => $this->faker->randomNumber(0),
            'user_id' => $user->id,
            'produk_id' => $produk->id,
        ];

        $response = $this->put(route('barangs.update', $barang), $data);

        $data['id'] = $barang->id;

        $this->assertDatabaseHas('barangs', $data);

        $response->assertRedirect(route('barangs.edit', $barang));
    }

    /**
     * @test
     */
    public function it_deletes_the_barang(): void
    {
        $barang = Barang::factory()->create();

        $response = $this->delete(route('barangs.destroy', $barang));

        $response->assertRedirect(route('barangs.index'));

        $this->assertModelMissing($barang);
    }
}
