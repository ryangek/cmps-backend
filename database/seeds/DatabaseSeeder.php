<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(LocationTableSeeder::class);
        $this->call(DeviceTableSeeder::class);
        $this->call(StatusTableSeeder::class);
    }
}
