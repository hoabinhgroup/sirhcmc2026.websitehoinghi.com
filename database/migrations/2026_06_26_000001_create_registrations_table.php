<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('guest_code', 150)->nullable()->index();
            $table->string('title', 300)->nullable();
            $table->string('fullname', 250);
            $table->string('position', 250)->nullable();
            $table->string('affiliation', 300)->nullable();
            $table->string('category', 100)->nullable();
            $table->boolean('galadinner')->default(false);
            $table->string('country', 120)->nullable()->default('VN');
            $table->unsignedTinyInteger('day')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('passport', 500)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 150);
            $table->string('dietary', 300)->nullable();
            $table->string('conference_fees', 500)->nullable();
            $table->decimal('total', 15, 2)->default(0);
            $table->string('attach', 500)->nullable();
            $table->string('oral_attach', 500)->nullable();
            $table->string('degree_file', 500)->nullable();
            $table->string('young_ir_proof', 500)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->boolean('is_international')->default(false);
            $table->string('orderinfo', 250)->nullable();
            $table->string('vpc_TransactionNo', 300)->nullable();
            $table->string('status', 50)->nullable();
            $table->string('txnResponseCode', 300)->nullable();
            $table->unsignedTinyInteger('checkin')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
