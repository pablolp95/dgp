<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned();

            $table->string('name');
            $table->text('description')->nullable();
            $table->string('floor')->nullable();
            $table->string('thematic')->nullable();
        });

        Schema::table('zones', function(Blueprint $table) {
            $table->foreign("user_id")
                ->references("id")
                ->on("users");
            $table->foreign("last_update_user_id")
                ->references("id")
                ->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('zones');
    }
}
