<?php

use Illuminate\Database\Seeder;

class SeriesActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $serieActors = [
            [
                'series_id' => '1',               
                'actor_id' => '1',
            ],
            [
                'series_id' => '1',
                'actor_id' => '2',
            ],
            [
                'series_id' => '2',
                'actor_id' => '2',
            ],
        ];

        foreach ($serieActors as $serieActor) {
            \Illuminate\Support\Facades\DB::table('series_actor')->insert($serieActor);
        }
    }
}
