<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('arname')->unique();
            $table->integer('seasons');
            $table->string('year');
            $table->text('overview');
            $table->text('background_cover');
            $table->text('poster');
            $table->timestamps();
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
        Schema::dropIfExists('series');
    }
}
