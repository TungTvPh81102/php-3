<?php

namespace Database\Seeders;

use App\Models\Currencie;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $currencyCodes = ["USD", "EUR", "JPY", "GBP", "AUD", "CAD", "VND"];
//        for ($i = 0; $i < 100; $i++) {
//            DB::table('transactions')->insert([
//                'account_id' => random_int(1, 100),
//                'transaction_type' => Arr::random([Transaction::TYPE_DEPOSIT, Transaction::TYPE_WITHDRAWAL, Transaction::TYPE_TRANSFER]),
//                'amount' => random_int(100, 1000),
//                'currency' => Arr::random($currencyCodes),
//                'transaction_date' => now(),
//                'description' => fake()->text(50),
//                'status' => Arr::random([Transaction::STATUS_PENDING, Transaction::STATUS_COMPLETED, Transaction::STATUS_FAILED]),
//                'created_at' => now(),
//                'updated_at' => now(),
//            ]);
//        }
        $startTime = microtime(true);
        $currencyCodes = Currencie::query()->pluck('currency_code')->all();
        $transactionTypes = [Transaction::TYPE_DEPOSIT, Transaction::TYPE_WITHDRAWAL, Transaction::TYPE_TRANSFER];
        $now = now();
        $statuses = [Transaction::STATUS_PENDING, Transaction::STATUS_COMPLETED, Transaction::STATUS_FAILED];

        for ($i = 1; $i < 100001; $i++) {
            $data [] = [
                'account_id' => rand(1, 20),
                'transaction_type' => $transactionTypes[$i % 3],
                'amount' => $i,
                'currency' => fake()->randomElement($currencyCodes),
                'transaction_date' => $now,
                'description' => fake()->text(50),
                'status' => $statuses[$i % 3],
                'created_at' => now(),
            ];

            if ($i % 500 == 0) {
                Transaction::query()->insert($data);
                $data = [];
            }
            echo 'Thêm mới bản ghi số:' . $i . PHP_EOL;
        }

        $endTime = microtime(true);

        echo 'Tổng thời gian: ' . ($endTime - $startTime);

    }
}
