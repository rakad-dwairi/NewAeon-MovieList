<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesCategoryTable extends Migration
{

   public function up()
   {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
       Schema::create('series_category', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('series_id');
           $table->unsignedBigInteger('category_id');
           $table->timestamps();

            $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            // $table->unique(['category_id']);
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
       Schema::dropIfExists('series_category');
   }
}
