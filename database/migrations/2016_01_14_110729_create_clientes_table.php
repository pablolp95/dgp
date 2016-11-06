<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("clientes", function (Blueprint $table) {
            $table->increments("id");
            $table->timestamps();

            $table->integer("user_id")->index()->unsigned();
            $table->integer("last_update_user_id")->index()->unsigned()->nullable();

            $table->string("img_url")->nullable();
            $table->string("type")->nullable();
            $table->string("name");
            $table->string("surname")->nullable();

            $table->string("invoicing_name")->nullable();
            $table->string("entity_type")->nullable();
            $table->string("nif",9)->unique();
            $table->tinyInteger("country")->nullable();
            $table->tinyInteger("state")->nullable();
            $table->string("city")->nullable();
            $table->string("zip_code",5)->nullable();
            $table->string("address_1")->nullable();
            $table->string("address_2")->nullable();

            $table->string("phone")->nullable();
            $table->string("mobile")->nullable();

            $table->string("email")->nullable();
            $table->text("notes")->nullable();
        });

        Schema::table("clientes", function(Blueprint $table)
        {
            $table->foreign("user_id")
                ->references("id")
                ->on("users");
            $table->foreign("last_update_user_id")
                ->references("id")
                ->on("users");
        });

        Schema::table("proyectos",function(Blueprint $table) {
            $table->foreign("client_id")
                ->references("id")
                ->on("clientes");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("proyectos",function(Blueprint $table) {
            $table->dropForeign("proyectos_client_id_foreign");
        });

        Schema::drop("clientes");
    }
}
