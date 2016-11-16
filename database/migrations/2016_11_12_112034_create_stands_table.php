<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stands', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned()->nullable();
            $table->integer('zone_id')->index()->unsigned()->nullable();
            $table->integer('route_id')->index()->unsigned()->nullable();

            $table->string('name');
        });

        Schema::table('stands', function(Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('last_update_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('zone_id')
                ->references('id')
                ->on('zones');
            $table->foreign('route_id')
                ->references('id')
                ->on('routes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stands');
    }
}
