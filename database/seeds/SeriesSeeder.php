<?php

use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
/**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $series = [
            [
                'name' => 'Lucifer',
                'seasons' => '3',
                'year' => '2019',
                'overview' => 'film1film1film1film1film1film1film1film1film1film1film1film1',
                'background_cover' => 'film_background_covers/film-bg.jpg',
                'poster' => 'film_posters/film-poster.jpg',
                ],
            [
                'name' => 'Breaking Bad',
                'seasons' => '2',
                'year' => '2020',
                'overview' => 'film2film2film2film2film2film2film2film2film2film2film2film2',
                'background_cover' => 'film_background_covers/film-bg.jpg',
                'poster' => 'film_posters/film-poster.jpg',
                ]
        ];

        foreach ($series as $serie){
            \App\Series::create($serie);
        }

    }
}
