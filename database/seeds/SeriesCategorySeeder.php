<?php

use Illuminate\Database\Seeder;

class SeriesCategorySeeder extends Seeder
{
  /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'series_id' => '1',
                'category_id' => '1',
            ],
            [
                'series_id' => '1',
                'category_id' => '2',
            ],
            [
                'series_id' => '2',
                'category_id' => '1',
            ],
        ];

        foreach ($categories as $categorie) {
            \Illuminate\Support\Facades\DB::table('series_category')->insert($categorie);
        }

    }
}
