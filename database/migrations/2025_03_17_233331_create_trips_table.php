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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transportation_company_id')->constrained('users')->onDelete('cascade');
            $table->string('driver_name');
            $table->string('plate_number');
            $table->string('destination');
            $table->string('transport_type'); // group, single
            $table->string('start');
            $table->string('end');
            $table->dateTime('go_date');
            $table->dateTime('back_date');
            $table->string('trip_type'); // one way or round trip
            $table->integer('number_of_seats');
            $table->string('distance');
            $table->decimal('price');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
