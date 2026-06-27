<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained()->cascadeOnDelete();
            $table->string('provider', 50)->default('onepay');
            $table->string('payment_method', 50)->nullable();
            $table->decimal('amount', 15, 2)->default(0);
            $table->decimal('transaction_fee', 15, 2)->default(0);
            $table->string('currency', 10)->default('VND');
            $table->string('gateway_transaction_id', 300)->nullable();
            $table->string('bank_transfer_reference', 300)->nullable();
            $table->string('status', 50)->default('pending');
            $table->timestamp('paid_at')->nullable();
            $table->json('raw_callback_json')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
