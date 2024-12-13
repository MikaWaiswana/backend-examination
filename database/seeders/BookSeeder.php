<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Faker\Factory as Faker;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $authorIds = Author::pluck('id')->toArray();
        $categoryIds = BookCategory::pluck('id')->toArray();
        $chunkSize = 1000; // Jumlah data per batch
        $totalRecords = 100000; // Total data yang ingin dimasukkan
        $data = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'title' => $faker->sentence,
                'author_id' => $faker->randomElement($authorIds),
                'category_id' => $faker->randomElement($categoryIds),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Masukkan data jika jumlahnya mencapai chunkSize
            if (count($data) === $chunkSize) {
                Book::insert($data);
                $data = []; // Kosongkan array untuk batch berikutnya
            }
        }

        // Masukkan data yang tersisa
        if (!empty($data)) {
            Book::insert($data);
        }
    }
}
