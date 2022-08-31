<?php

use Illuminate\Database\Seeder;

class ServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servers = [
            ['name' => 'AWS'],
            ['name' => 'AZURE'],
            ['name' => 'PHPAdmin'],
        ];

        foreach ($servers as $server) {
            \App\Server::create($server);
        }
    }
}
