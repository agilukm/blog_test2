<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('author', 100);
            $table->timestamps();
        });
        Schema::create('metas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value', 100);
            $table->integer('posts_id')->unsigned();
            $table->foreign('posts_id')->references('id')->on('posts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
        Schema::dropIfExists('metas');
        }
}

