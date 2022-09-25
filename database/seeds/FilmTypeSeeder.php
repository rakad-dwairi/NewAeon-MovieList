<?php

use Illuminate\Database\Seeder;

class FilmTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $filmTypes = [
            [
                'film_id' => '1',
                'type_id' => '1',
            ],
            [
                'film_id' => '1',
                'type_id' => '2',
            ],
            
            [
                'film_id' => '2',
                'type_id' => '1',
            ],
        ];

        foreach ($filmTypes as $filmType) {
            \Illuminate\Support\Facades\DB::table('film_type')->insert($filmType);
        }
    }
}
