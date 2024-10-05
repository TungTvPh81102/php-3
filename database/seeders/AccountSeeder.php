<?php

namespace Database\Seeders;

use App\Models\Account;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            DB::table('accounts')->insert([
                'account_number' => fake()->creditCardNumber,
                'account_name' => fake()->name,
                'balance' =>fake()->numberBetween(1000000, 10000000),
                'account_type' => Arr::random([Account::TYPE_SAVING, Account::TYPE_CHECKING, Account::TYPE_CREDIT]),
                'is_active' => rand(0, 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
