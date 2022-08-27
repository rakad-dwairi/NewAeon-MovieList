<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(FilmSeeder::class);
        $this->call(FilmCategorySeeder::class);
        $this->call(SeriesCategorySeeder::class);
        $this->call(SeriesSeeder::class);
        $this->call(SeasonsSeeder::class);
        $this->call(EposideSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(FavoriteSeeder::class);
        $this->call(ActorSeeder::class);
        $this->call(FilmActorSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
