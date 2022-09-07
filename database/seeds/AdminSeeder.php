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
            'name'      => 'NewAeon Admin',
            'email'     => 'admin@admin.com',
            'password'  => bcrypt(123456)
        ]);

        $admin->attachRole('super_admin');
    }
}
