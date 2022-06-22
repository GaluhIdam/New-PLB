<?php

namespace Database\Seeders;

use App\Models\ActivityHistory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityHistory::create([
            'username' => 'admin',
            'time' => date('Y-m-d H:i:s'),
            'activity' => 'Akses Dashboard',
        ]);
    }
}
