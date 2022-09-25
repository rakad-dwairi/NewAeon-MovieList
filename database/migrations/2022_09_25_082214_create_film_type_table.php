<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilmTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('film_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('film_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();

            $table->foreign('film_id')->references('id')->on('films')->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');

            $table->unique(['film_id','type_id']);
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
        Schema::dropIfExists('film_type');
    }
}
