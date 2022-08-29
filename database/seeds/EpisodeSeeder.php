<?php

use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $episodes = [
            [
                'series_id'=>'1',
                'seasons_id'=>'1',
                'name' => 'Finding My Self',
                'background_cover' => 'film_background_covers/film-bg.jpg',
                'poster' => 'film_posters/film-poster.jpg',
                'url' => '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="Thu Jun 11 2020 21:21:24 GMT+0300 (توقيت شرق أوروبا الصيفي)"/><meta itemprop="name" content="Ip Man 4 (2019) Official Us Theatrical Trailer   Donnie Yen, Scott Adkins &amp; Danny Chan As Bruce Lee (1)"/><meta itemprop="duration" content="PT1M45.164S" /><meta itemprop="thumbnailUrl" content="https://content.jwplatform.com/thumbs/hgmsBKyV-1280.jpg"/><meta itemprop="contentUrl" content="https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4"/><script src="https://cdn.jwplayer.com/players/hgmsBKyV-mBCrmi1a.js"></script></div>',
                'api_url' => 'https://cdn.jwplayer.com/manifests/hgmsBKyV.m3u8',
                
            ],


            [
                'series_id'=>'1',
                'seasons_id'=>'1',
                'name' => 'Looking for heaven',
                'background_cover' => 'film_background_covers/film-bg.jpg',
                'poster' => 'film_posters/film-poster.jpg',
                'url' => '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="Thu Jun 11 2020 21:21:24 GMT+0300 (توقيت شرق أوروبا الصيفي)"/><meta itemprop="name" content="Ip Man 4 (2019) Official Us Theatrical Trailer   Donnie Yen, Scott Adkins &amp; Danny Chan As Bruce Lee (1)"/><meta itemprop="duration" content="PT1M45.164S" /><meta itemprop="thumbnailUrl" content="https://content.jwplatform.com/thumbs/hgmsBKyV-1280.jpg"/><meta itemprop="contentUrl" content="https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4"/><script src="https://cdn.jwplayer.com/players/hgmsBKyV-mBCrmi1a.js"></script></div>',
                'api_url' => 'https://cdn.jwplayer.com/manifests/hgmsBKyV.m3u8',
                
            ],
                
            [
                'series_id'=>'1',
                'seasons_id'=>'1',
                'name' => 'Forgivness',
                'background_cover' => 'film_background_covers/film-bg.jpg',
                'poster' => 'film_posters/film-poster.jpg',
                'url' => '<div itemscope itemtype="https://schema.org/VideoObject"><meta itemprop="uploadDate" content="Thu Jun 11 2020 21:21:24 GMT+0300 (توقيت شرق أوروبا الصيفي)"/><meta itemprop="name" content="Ip Man 4 (2019) Official Us Theatrical Trailer   Donnie Yen, Scott Adkins &amp; Danny Chan As Bruce Lee (1)"/><meta itemprop="duration" content="PT1M45.164S" /><meta itemprop="thumbnailUrl" content="https://content.jwplatform.com/thumbs/hgmsBKyV-1280.jpg"/><meta itemprop="contentUrl" content="https://content.jwplatform.com/videos/hgmsBKyV-zJl9Il4I.mp4"/><script src="https://cdn.jwplayer.com/players/hgmsBKyV-mBCrmi1a.js"></script></div>',
                'api_url' => 'https://cdn.jwplayer.com/manifests/hgmsBKyV.m3u8',
                ],
                
        ];

        foreach ($episodes as $episode){
            \App\Episode::create($episode);
        }
    }
}
