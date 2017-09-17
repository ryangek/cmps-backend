<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'stat_switch' => 'close',
            'stat_ultra' => 'no',
            'stat_device' => 1101
        ]);

        DB::table('status')->insert([
            'stat_switch' => 'close',
            'stat_ultra' => 'no',
            'stat_device' => 1102
        ]);

        DB::table('status')->insert([
            'stat_switch' => 'close',
            'stat_ultra' => 'no',
            'stat_device' => 1103
        ]);
    }
}
