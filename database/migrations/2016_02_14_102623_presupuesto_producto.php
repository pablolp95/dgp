<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PresupuestoProducto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("presupuesto_producto", function (Blueprint $table) {
            $table->increments("id");
            $table->timestamps();

            $table->integer("producto_id")->index()->unsigned();
            $table->integer("presupuesto_id")->index()->unsigned();

        });

        Schema::table("presupuesto_producto", function(Blueprint $table)
        {
            $table->foreign("producto_id")
                ->references("id")
                ->on("productos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
            $table->foreign("presupuesto_id")
                ->references("id")
                ->on("presupuestos")
                ->onDelete("cascade")
                ->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop("presupuesto_producto");
    }
}
