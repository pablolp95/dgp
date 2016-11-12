<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('name');
            $table->string('filename')->nullable();
            $table->string('original_filename')->nullable();
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
        });

        Schema::table('images', function(Blueprint $table) {
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
        Schema::drop('images');
    }
}
