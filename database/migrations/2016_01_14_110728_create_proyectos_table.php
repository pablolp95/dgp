<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("proyectos", function (Blueprint $table) {
            $table->increments("id");
            $table->timestamps();

            $table->integer("user_id")->index()->unsigned();
            $table->integer("client_id")->index()->unsigned();
            $table->integer("last_update_user_id")->index()->unsigned()->nullable();

            $table->string("name");
            $table->string("img_url")->nullable();
            $table->date("starting_date");
            $table->date("ending_date");
            $table->text("notes")->nullable();

        });

        Schema::table("proyectos", function(Blueprint $table)
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
        Schema::drop("proyectos");
    }
}
