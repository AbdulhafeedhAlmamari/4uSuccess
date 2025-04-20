<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('consultation_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('consultant_id')->constrained('users')->onDelete('cascade');
            $table->string('specialization');
            $table->string('subject');
            $table->string('type');
            $table->integer('gender'); // 1 for male, 0 for female
            $table->text('description');
            $table->text('reply')->nullable();
            $table->string('status');
            $table->dateTime('request_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('consultation_requests');
    }
};
