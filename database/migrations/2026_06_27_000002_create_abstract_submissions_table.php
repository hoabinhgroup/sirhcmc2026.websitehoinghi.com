<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('abstract_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('submission_code', 150)->nullable()->index();
            $table->string('locale', 10)->default('vi');
            $table->string('presenter_scope', 20)->default('domestic');
            $table->string('abstract_category', 100);
            $table->string('title', 300)->nullable();
            $table->string('fullname', 250);
            $table->string('affiliation', 300)->nullable();
            $table->string('position', 250)->nullable();
            $table->unsignedTinyInteger('day')->nullable();
            $table->unsignedTinyInteger('month')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('citizen_id', 20)->nullable();
            $table->string('country', 120)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('email', 150);
            $table->string('dietary', 300)->nullable();
            $table->string('abstract_file', 500)->nullable();
            $table->string('cv_file', 500)->nullable();
            $table->string('headshot_file', 500)->nullable();
            $table->string('degree_file', 500)->nullable();
            $table->string('status', 50)->default('submitted');
            $table->text('review_note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('abstract_submissions');
    }
};
