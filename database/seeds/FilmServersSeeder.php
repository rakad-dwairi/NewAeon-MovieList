<?php

use Illuminate\Database\Seeder;

class FilmServersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filmServers = [
            [
                'film_id' => '1',
                'server_id' => '1',
            ],
            [
                'film_id' => '1',
                'server_id' => '2',
            ],
            
            [
                'film_id' => '2',
                'server_id' => '3',
            ],
        ];

        foreach ($filmServers as $filmServer) {
            \Illuminate\Support\Facades\DB::table('film_server')->insert($filmServer);
        }
    }
}
