<?php

use Illuminate\Database\Seeder;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('location')->insert([
            'locate_id' => '1100',
            'locate_name' => 'LO_1100',
            'locate_floor' => '1',
            'locate_quantity' => 0
        ]);
    }
}
