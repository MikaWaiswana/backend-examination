<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        $chunkSize = 100; // Jumlah data per batch
        $totalRecords = 1000; // Total data yang ingin dimasukkan
        $data = [];

        for ($i = 0; $i < $totalRecords; $i++) {
            $data[] = [
                'name' => $faker->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Masukkan data jika jumlahnya mencapai chunkSize
            if (count($data) === $chunkSize) {
                Author::insert($data);
                $data = []; // Kosongkan array untuk batch berikutnya
            }
        }

        // Masukkan data yang tersisa
        if (!empty($data)) {
            Author::insert($data);
        }
    }
}
