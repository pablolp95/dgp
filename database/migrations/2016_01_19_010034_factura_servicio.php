<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaServicio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_servicio', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('servicio_id')->index()->unsigned();
            $table->integer('factura_id')->index()->unsigned();

        });

        Schema::table('factura_servicio', function(Blueprint $table)
        {
            $table->foreign("servicio_id")
                ->references("id")
                ->on("servicios")
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign("factura_id")
                ->references("id")
                ->on("facturas")
                ->onDelete('cascade')
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
        Schema::drop('factura_servicio');
    }
}
