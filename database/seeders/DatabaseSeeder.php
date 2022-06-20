<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CustomsInboundDocumentSeeder::class,
            CustomsOutboundDocumentSeeder::class,
            HoardingTimeSeeder::class,
            LoginHistorySeeder::class,
<<<<<<< HEAD
            ActivityHistorySeeder::class,
=======
            MutationPeriodicSeeder::class,
            MutationSeeder::class,
            OutboundSeeder::class,
            UserSeeder::class,
>>>>>>> 3faa9dbe2c7e15a4c652f3e8e63e6f2fed6457e1
        ]);
    }
}
