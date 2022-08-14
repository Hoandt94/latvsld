<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'phone' => '',
             'email' => '',
             'company' => '',
             'position' => '',
             'specific_professions' => '',
             'status' => 1,
             'license_type' => 1,
            'role' => 'system_admin'
        ]);
    }
}
