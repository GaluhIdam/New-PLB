<?php

namespace Database\Seeders;

use App\Models\MutationCalculation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutationCalculationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MutationCalculation::factory()->count(30)->create();
    }
}
