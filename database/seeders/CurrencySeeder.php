<?php

namespace Database\Seeders;

use App\Models\Currencie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencyCodes = ["USD", "EUR", "JPY", "GBP", "AUD", "CAD", "VND"];

        foreach ($currencyCodes as $item) {
            DB::table('currencies')->insert([
                'currency_code' => $item,
                'exchange_rate' => random_int(1, 100),
                'updated_at' => now(),
            ]);

        }

    }
}
