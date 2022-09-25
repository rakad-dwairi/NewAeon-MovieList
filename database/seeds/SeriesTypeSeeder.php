<?php

use Illuminate\Database\Seeder;

class SeriesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = [
            [
                'series_id' => '1',
                'type_id' => '2',
            ],
            [
                'series_id' => '2',
                'type_id' => '1',
            ],
        ];

        foreach ($types as $type) {
            \Illuminate\Support\Facades\DB::table('series_type')->insert($type);
        }

    }
}
