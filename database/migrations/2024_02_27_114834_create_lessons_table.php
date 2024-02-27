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
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();

            $table->string("name");
            $table->string("short_description");
            $table->text("long_description");
            $table->date("season_start");
            $table->date("season_end");
            $table->integer("age_min");
            $table->integer("age_max");
            $table->decimal("price");
            $table->string("cover_img_path");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lessons');
    }
};
