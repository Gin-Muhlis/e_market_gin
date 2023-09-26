<?php

namespace Database\Factories;

use App\Models\Pemasok;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PemasokFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pemasok::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_pemasok' => $this->faker->text(50),
        ];
    }
}
