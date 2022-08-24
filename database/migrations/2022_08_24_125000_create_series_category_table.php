<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesCategoryTable extends Migration
{

   public function up()
   {
       Schema::create('series_category', function (Blueprint $table) {
           $table->id();
           $table->unsignedBigInteger('series_id');
           $table->unsignedBigInteger('category_id');
           $table->timestamps();

            // $table->foreign('series_id')->references('id')->on('series')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->unique(['series_id', 'category_id']);
       });
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
