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
            ['name' => 'Horror'],
            ['name' => 'Comedian'],
            ['name' => 'Romance'],
        ];

        foreach ($categories as $category) {
            \App\Category::create($category);
        }
    }
}
