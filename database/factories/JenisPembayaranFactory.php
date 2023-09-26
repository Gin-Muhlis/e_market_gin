<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\JenisPembayaran;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisPembayaranFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = JenisPembayaran::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->text(255),
        ];
    }
}
