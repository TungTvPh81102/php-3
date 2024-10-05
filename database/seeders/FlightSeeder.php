<?php

namespace Database\Seeders;

use App\Models\Flight;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            Flight::query()->create([
                'name' => fake()->name,
                'options' => json_encode([
                    'delay' => rand(0, 1),
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
