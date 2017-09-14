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
        DB::table('users')->insert([
            'name' => 'device',
            'status' => 'administrator',
            'email' => 'device@localhost.com',
            'password' => bcrypt('secret'),
            'api_token' => 'CrhYoNNpyO5pVexYii44UCLX2clotzMp4Q9uXA7hUw6Z0WAwIJBXINehSafb',
        ]);
    }
}
