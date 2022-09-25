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
            ['name' => 'Arabic'],
            ['name' => 'English'],
            ['name' => 'Turkey'],
        ];

        foreach ($types as $type) {
            \App\Type::create($type);
        }
    }
}
