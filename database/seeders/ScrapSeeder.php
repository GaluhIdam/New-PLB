<?php

namespace Database\Seeders;

use App\Models\Scrap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScrapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scrap::factory()->count(30)->create();
    }
}