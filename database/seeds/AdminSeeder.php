<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Admin::create([
            'name'      => 'Rakad Dwairi',
            'email'     => 'rakad@gmail.com',
            'password'  => bcrypt(123456)
        ]);

        $admin->attachRole('super_admin');
    }
}
