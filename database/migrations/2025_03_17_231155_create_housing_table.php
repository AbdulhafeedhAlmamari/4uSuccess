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
        Schema::create('housing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('housing_company_id')->constrained('users')->onDelete('cascade');
            $table->string('address');
            $table->decimal('distance_from_university', 8, 2);
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->text('features')->nullable();
            $table->string('housing_type');
            $table->text('rules');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('housing');
    }
};
