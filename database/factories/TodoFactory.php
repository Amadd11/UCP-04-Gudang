<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Satuan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'user_id' => rand(1, 100),
            'user_id' => User::inRandomOrder()->first()->id,
            // 'category_id' => rand(1, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => ucwords(fake()->sentence()),
            'jumlah' => ucwords(fake()->sentence()),
            'satuan_id' => Satuan::inRandomOrder()->first()->id,
            'is_complete' => rand(0, 1)
        ];
    }
}
