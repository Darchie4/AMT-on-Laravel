<?php

namespace Database\Seeders;

use App\Models\PricingStructure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PricingStructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PricingStructure::create([
            'name'=>'Standard',
            'price'=>700,
            'payment_frequency'=>'quarterly',
            'frequency_multiplier'=>1
        ]);
    }
}
