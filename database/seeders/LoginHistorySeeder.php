<?php

namespace Database\Seeders;

use App\Models\LoginHistory;
use Illuminate\Database\Seeder;

class LoginHistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoginHistory::create([
            'username' => 'user_jti',
            'time' => date('Y-m-d H:i:s'),
            'ip_address' => '192.168.0.1',
            'user_agent' => 'Unknown Windows OS-Chrome 69.0.3497.92',
        ]);
    }
}
