<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rating;
use App\Models\Book;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Log;

class RatingSeeder extends Seeder
{
    public function run(): void
    {
        // Set memori
        ini_set('memory_limit', '2G');  // Set batas memori

        $faker = Faker::create();
        $booksIds = Book::pluck('id')->toArray(); // Ambil semua ID buku
        $chunkSize = 500; // Jumlah data per batch
        $totalRecords = 500000; // Total data yang ingin dimasukkan
        $data = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'book_id' => $faker->randomElement($booksIds),
                'rating' => $faker->numberBetween(1, 10), // Rating antara 1 hingga 10
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Debugging: Cek setiap 10000 record
            if ($i % 10000 === 0) {
                Log::info("Seeding Rating: $i records processed.");
            }

            // Masukkan data jika jumlahnya mencapai chunkSize
            if (count($data) === $chunkSize) {
                try {
                    Rating::insert($data);
                    Log::info("Inserted $chunkSize ratings.");
                } catch (\Exception $e) {
                    Log::error("Error inserting ratings: " . $e->getMessage());
                }
                $data = []; // Kosongkan array untuk batch berikutnya
            }
        }

        // Masukkan data yang tersisa
        if (!empty($data)) {
            try {
                Rating::insert($data);
                Log::info("Inserted remaining ratings.");
            } catch (\Exception $e) {
                Log::error("Error inserting remaining ratings: " . $e->getMessage());
            }
        }
    }
}
