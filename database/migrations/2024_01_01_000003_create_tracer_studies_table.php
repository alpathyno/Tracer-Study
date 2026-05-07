<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tracer_studies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->enum('status', ['working', 'studying', 'entrepreneur', 'unemployed']);
            $table->string('company_name')->nullable();
            $table->string('job_position')->nullable();
            $table->decimal('salary', 15, 2)->nullable();
            $table->integer('waiting_time');
            $table->integer('job_relevance')->default(1);
            $table->string('university_name')->nullable();
            $table->string('study_major')->nullable();
            $table->string('level')->nullable();
            $table->text('feedback')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracer_studies');
    }
};