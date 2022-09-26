<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            [
                'name' => 'Horror',
                'arname' => 'رعب'
            ],
            [
                'name' => 'Comedian',
                'arname' => 'كوميديا'
            ],
            [
                'name' => 'Romance',
                'arname' => 'رومانسي'
            ],
        ];

        foreach ($categories as $category) {
            \App\Category::create($category);
        }
    }
}
