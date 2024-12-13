<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BookCategory;
use Faker\Factory as Faker;

class BookCategorySeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $chunkSize = 100; // Jumlah data per batch
        $totalRecords = 3000; // Total data yang ingin dimasukkan
        $data = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'category_name' => $faker->word,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Masukkan data jika jumlahnya mencapai chunkSize
            if (count($data) === $chunkSize) {
                BookCategory::insert($data);
                $data = []; // Kosongkan array untuk batch berikutnya
            }
        }

        // Masukkan data yang tersisa
        if (!empty($data)) {
            BookCategory::insert($data);
        }
    }
}
