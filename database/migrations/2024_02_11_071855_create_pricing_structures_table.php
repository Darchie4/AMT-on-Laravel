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
        Schema::create('pricing_structures', function (Blueprint $table) {

            $allowedFrequencies = ['weekly', 'monthly', 'quarterly', 'biannually', 'annually'];

            $table->id();
            $table->string('name');
            $table->decimal('price');
            $table->enum('payment_frequency',$allowedFrequencies);
            $table->decimal('frequency_multiplier',5)->default(1)->after('payment_frequency');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_structures');
    }
};
