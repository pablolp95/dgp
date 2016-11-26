<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('texts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned()->nullable();
            $table->integer('stand_id')->index()->unsigned()->nullable();
            $table->integer('language_id')->index()->unsigned()->nullable();

            $table->string('name');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
        });

        Schema::table('texts', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('last_update_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('stand_id')
                ->references('id')
                ->on('stands')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('texts');
    }
}
