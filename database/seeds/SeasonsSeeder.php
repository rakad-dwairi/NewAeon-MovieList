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
                'name' => 'Season 1',
                'series_id' => '1',
                'background_cover' => 'film_background_covers/film-bg.jpg'
            ],
            [
                'name' => 'Season 1',
                'series_id' => '2',
                'background_cover' => 'film_background_covers/film-bg.jpg'
            ]
        ];

        foreach ($seasons as $season) {
            \App\Seasons::create($season);
        }
    }
}
