<?php

namespace Database\Seeders;

use App\Models\MutationReport;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MutationReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MutationReport::factory()->count(30)->create();
    }
}
