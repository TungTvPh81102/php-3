<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class RenderData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('accounts')->insert([
                'account_number' => Str::random(10),
                'account_name' => fake()->name(),
                'balance' => random_int(100, 1000),
                'account_type' => Arr::random([Account::TYPE_SAVING, Account::TYPE_CHECKING, Account::TYPE_CREDIT]),
                'is_active' => Arr::random([0, 1]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // $currencyCodes = ["USD", "EUR", "JPY", "GBP", "AUD", "CAD", "VND"];

        // foreach ($currencyCodes as $item) {
        //     DB::table('currencies')->insert([
        //         'currency_code' => $item,
        //         'exchange_rate' => random_int(1, 100),
        //         'updated_at' => now(),
        //     ]);
        // }

        for ($i = 0; $i < 100; $i++) {
            DB::table('transactions')->insert([
                'account_id' => random_int(1, 100),
                'currencie_id' => random_int(1, 7),
                'transaction_type' => Arr::random([Transaction::TYPE_DEPOSIT, Transaction::TYPE_WITHDRAWAL, Transaction::TYPE_TRANSFER]),
                'amount' => random_int(100, 1000),
                'currency' => Arr::random(['USD', 'EUR']),
                'transaction_date' => now(),
                'description' => fake()->text(50),
                'status' => Arr::random([Transaction::STATUS_PENDING, Transaction::STATUS_COMPLETED, Transaction::STATUS_FAILED]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
