<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'administrator',
            'status' => 'administrator',
            'email' => 'admin@localhost.com',
            'password' => bcrypt('secret'),
            'api_token' => str_random(60),
        ]);
    }
}
