<?php

use Illuminate\Database\Seeder;

class DeviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('device')->insert([
            'device_id' => '1101',
            'device_name' => 'DV_1101',
            'device_status' => 'no',
            'device_top' => 33.333,
            'device_left' => 33.333,
            'locate_id' => 1100
        ]);
        DB::table('device')->insert([
            'device_id' => '1102',
            'device_name' => 'DV_1102',
            'device_status' => 'no',
            'device_top' => 59.234,
            'device_left' => 50.226,
            'locate_id' => 1100
        ]);
        DB::table('device')->insert([
            'device_id' => '1103',
            'device_name' => 'DV_1103',
            'device_status' => 'yes',
            'device_top' => 23.234,
            'device_left' => 12.234,
            'locate_id' => 1100
        ]);
    }
}
