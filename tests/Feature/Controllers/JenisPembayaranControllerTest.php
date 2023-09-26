<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\JenisPembayaran;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JenisPembayaranControllerTest extends TestCase
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
    public function it_displays_index_view_with_jenis_pembayarans(): void
    {
        $jenisPembayarans = JenisPembayaran::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('jenis-pembayarans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.jenis_pembayarans.index')
            ->assertViewHas('jenisPembayarans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_jenis_pembayaran(): void
    {
        $response = $this->get(route('jenis-pembayarans.create'));

        $response->assertOk()->assertViewIs('app.jenis_pembayarans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_jenis_pembayaran(): void
    {
        $data = JenisPembayaran::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('jenis-pembayarans.store'), $data);

        $this->assertDatabaseHas('jenis_pembayarans', $data);

        $jenisPembayaran = JenisPembayaran::latest('id')->first();

        $response->assertRedirect(
            route('jenis-pembayarans.edit', $jenisPembayaran)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_jenis_pembayaran(): void
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $response = $this->get(
            route('jenis-pembayarans.show', $jenisPembayaran)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.jenis_pembayarans.show')
            ->assertViewHas('jenisPembayaran');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_jenis_pembayaran(): void
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $response = $this->get(
            route('jenis-pembayarans.edit', $jenisPembayaran)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.jenis_pembayarans.edit')
            ->assertViewHas('jenisPembayaran');
    }

    /**
     * @test
     */
    public function it_updates_the_jenis_pembayaran(): void
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $data = [
            'nama' => $this->faker->text(255),
        ];

        $response = $this->put(
            route('jenis-pembayarans.update', $jenisPembayaran),
            $data
        );

        $data['id'] = $jenisPembayaran->id;

        $this->assertDatabaseHas('jenis_pembayarans', $data);

        $response->assertRedirect(
            route('jenis-pembayarans.edit', $jenisPembayaran)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_jenis_pembayaran(): void
    {
        $jenisPembayaran = JenisPembayaran::factory()->create();

        $response = $this->delete(
            route('jenis-pembayarans.destroy', $jenisPembayaran)
        );

        $response->assertRedirect(route('jenis-pembayarans.index'));

        $this->assertModelMissing($jenisPembayaran);
    }
}
