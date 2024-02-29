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
        Schema::create('lesson_time_locations', function (Blueprint $table) {
            $table->id();

            $table->integer("week_day");
            $table->time("start_time");
            $table->time("end_time");

            $table->foreignId("lesson_id");
            $table->foreignId("location_id");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_time_locations');
    }
};
