<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'nick_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'phone' => '0964846895',
                'address' => 'Hà Nội',
                'type' => 1,
                'password' => bcrypt('123456'),
            ]
        ]);
    }
}
