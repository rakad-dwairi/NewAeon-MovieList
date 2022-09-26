<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $types = [
            [
                'name' => 'Arabic',
                'arname' => 'عربي'

            ],
            [
                'name' => 'English',
                'arname' => 'انجليزي'

            ],
            [
                'name' => 'Turkey',
                'arname' => 'تركي'

            ],
        ];

        foreach ($types as $type) {
            \App\Type::create($type);
        }
    }
}
