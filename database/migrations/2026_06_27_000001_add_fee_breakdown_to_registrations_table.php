<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->string('locale', 10)->nullable()->after('is_international');
            $table->string('price_period', 20)->nullable()->after('total');
            $table->decimal('base_fee', 15, 2)->default(0)->after('price_period');
            $table->decimal('gala_fee_amount', 15, 2)->default(0)->after('base_fee');
            $table->decimal('transaction_fee', 15, 2)->default(0)->after('gala_fee_amount');
            $table->timestamp('paid_at')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('registrations', function (Blueprint $table) {
            $table->dropColumn([
                'locale',
                'price_period',
                'base_fee',
                'gala_fee_amount',
                'transaction_fee',
                'paid_at',
            ]);
        });
    }
};
