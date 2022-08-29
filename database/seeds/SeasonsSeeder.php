<?php

use Illuminate\Database\Seeder;

class SeasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seasons = [
            [
                'name' => 'God',
                'no_episodes'=>'4',
                'series_id' => '1',
                'background_cover' => 'film_background_covers/film-bg.jpg'
            ],
            [
                'name' => 'Devil',
                'no_episodes'=>'4',
                'series_id' => '1',
                'background_cover' => 'film_background_covers/film-bg.jpg'
            ],
            [
                'name' => 'Angels',
                'no_episodes'=>'2',
                'series_id' => '1',
                'background_cover' => 'film_background_covers/film-bg.jpg'
            ]
        ];

        foreach ($seasons as $season) {
            \App\Seasons::create($season);
        }
    }
}
