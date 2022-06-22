<?php

namespace Database\Seeders;

use App\Models\HoardingTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HoardingTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HoardingTime::factory()->count(30)->create();
    }
}
