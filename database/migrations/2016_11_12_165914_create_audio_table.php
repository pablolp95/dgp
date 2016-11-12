<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned()->nullable();

            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->text('description')->nullable();
            $table->string('audio_url')->nullable();
            $table->string('language')->nullable();
        });

        Schema::table('audio', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('last_update_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('audio');
    }
}
