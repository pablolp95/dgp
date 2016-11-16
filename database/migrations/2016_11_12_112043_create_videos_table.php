<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned()->nullable();
            $table->integer('stand_id')->index()->unsigned()->nullable();
            $table->integer('language_id')->index()->unsigned()->nullable();

            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->text('description')->nullable();
            $table->string('video_url')->nullable();
        });

        Schema::table('videos', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('last_update_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('stand_id')
                ->references('id')
                ->on('stands');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('videos');
    }
}
