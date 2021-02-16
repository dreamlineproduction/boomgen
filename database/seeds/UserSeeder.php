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
            'firstname' => 'admin',
            'lastname' => 'admin',
            'username' => 'admin.admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin@123'),
            'image'=> "",
            'phonenumber' => '112233445566',
            'address1' => 'address1',
             'address1' => 'address2',
            'state' => 'state',
            'type' => 'admin',
            'zip' => '121313',
            'status' => "1"
        ]);
    }
}
