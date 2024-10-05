<?php

use App\Models\Account;
use App\Models\Currencie;
use App\Models\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Account::class)->constrained();
            $table->enum(
                'transaction_type',
                [Transaction::TYPE_DEPOSIT, Transaction::TYPE_WITHDRAWAL, Transaction::TYPE_TRANSFER]
            )->default(Transaction::TYPE_WITHDRAWAL);
            $table->decimal('amount', 10, 2);
            $table->string('currency',10)->index();
            $table->dateTime('transaction_date');
            $table->text('description')->nullable();
            $table->enum('status', [
                Transaction::STATUS_PENDING,
                Transaction::STATUS_COMPLETED,
                Transaction::STATUS_FAILED,
            ])->default(Transaction::STATUS_PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
