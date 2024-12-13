<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BookCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookCategory>
 */
class BookCategoryFactory extends Factory
{
    protected $model = BookCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => $this->faker->word,
        ];
    }
}
