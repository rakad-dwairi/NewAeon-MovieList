<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Schema::create('series_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->unsignedBigInteger('type_id');
            $table->timestamps();
 
             $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
             $table->foreign('type_id')->references('id')->on('type')->onDelete('cascade');
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
        Schema::dropIfExists('series_type');
    }
}
