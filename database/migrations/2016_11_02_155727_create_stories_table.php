<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chapter')->nullable();
            $table->string('number')->nullable();
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->longText('content')->nullable();
            $table->integer('author')->default(1);
            $table->integer('publisher')->default(1);
            $table->string('image')->nullable();
            $table->string('slug')->nullable();
            $table->bigInteger('categories_id')->unsigned();
            $table->foreign('categories_id')->references('id')->on('categories')->onDelete('cascade');
            $table->bigInteger('tags_id')->unsigned();
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stories');
    }
}
