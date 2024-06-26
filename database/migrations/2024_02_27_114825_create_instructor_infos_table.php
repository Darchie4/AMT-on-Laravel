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
        Schema::create('instructor_infos', function (Blueprint $table) {
            $table->id();

            $table->string("short_description");
            $table->text("long_description");
            $table->string("profile_img_path")->unique()->nullable();
            $table->foreignId("user_id")->constrained()->cascadeOnDelete()->cascadeOnDelete();



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instructor_infos');
    }
};
