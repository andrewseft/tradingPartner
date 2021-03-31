<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'email' => 'info@tradingPartner.com',
            'support_email' => 'info@tradingPartner.com',
            'number' => '+91123456789',
            'name' => 'Trading Partner',
            'address' => 'Jaipur rajasthan india',
            'copy_right' => 'tradingPartner',
            'admin_limit' => 50,
            'front_limit' => 50,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
