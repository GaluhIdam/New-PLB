<?php

namespace Database\Seeders;

use App\Models\Mutation;
use Illuminate\Database\Seeder;

class MutationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Mutation::factory()->count(30)->create();
    }
}
