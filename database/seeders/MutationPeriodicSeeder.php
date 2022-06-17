<?php

namespace Database\Seeders;

use App\Models\MutationPeriodic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutationPeriodicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MutationPeriodic::factory()->count(30)->create();
    }
}
