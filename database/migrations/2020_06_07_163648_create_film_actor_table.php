<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmActorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('film_actor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            // $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();

            // $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');

            $table->unique(['film_id', 'actor_id']);
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
        Schema::dropIfExists('film_actor');
    }
}
