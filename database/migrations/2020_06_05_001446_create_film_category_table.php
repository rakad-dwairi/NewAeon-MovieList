<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('film_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['film_id', 'category_id']);
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('film_category');
    }
}
