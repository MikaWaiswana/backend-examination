<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Book;
use App\Models\BookCategory;
use App\Models\Author;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'category_id' => BookCategory::inRandomOrder()->first()->id,
            'author_id' => Author::inRandomOrder()->first()->id,
        ];
    }
}
