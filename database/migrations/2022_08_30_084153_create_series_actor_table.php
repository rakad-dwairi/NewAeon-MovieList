<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesActorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_actor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('actor_id');
            $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('actor_id')->references('id')->on('actors')->onDelete('cascade');

            // $table->unique(['actor_id']);
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_actor');
    }
}
