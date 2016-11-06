<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiciosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('last_update_user_id')->index()->unsigned();

            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->string('img_url')->nullable();
            $table->string('development_time')->nullable();
            $table->dateTime('starting_date')->nullable();
            $table->dateTime('ending_date')->nullable();
            $table->integer('invoice_period')->default(30); //DAYS
            $table->string('status')->nullable();
        });

        Schema::table('servicios', function(Blueprint $table)
        {
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
        Schema::drop('servicios');
    }
}
