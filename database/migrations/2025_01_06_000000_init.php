<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Init extends Migration
{

    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id('id');
            $table->string('title', 128);
            $table->text('description');
            $table->string('image', 64)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->date('start_date');
            $table->date('finish_date');
            $table->timestamps();
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        Schema::create('movies_2_genres', function (Blueprint $table) {
            $table->foreignId('movie_id')->references('id')->on('movies')->cascadeOnDelete();
            $table->foreignId('genre_id')->references('id')->on('genres')->cascadeOnDelete();
            $table->dateTime('created_at');
            $table->unique(['movie_id', 'genre_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('movies_2_genres');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('movies');
    }
}
