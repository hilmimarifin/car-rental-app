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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("car_id");
            $table->unsignedBigInteger("user_id");
            $table->date("start_date");
            $table->date("end_date");
            $table->date("actual_end_date")->nullable();

            $table->foreign("user_id")->on("users")->references("id");
            $table->foreign("car_id")->on("cars")->references("id");



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
