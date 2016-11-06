<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FacturaImpuesto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_impuesto', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('impuesto_id')->index()->unsigned();
            $table->integer('factura_id')->index()->unsigned();

        });

        Schema::table('factura_impuesto', function(Blueprint $table)
        {
            $table->foreign("impuesto_id")
                ->references("id")
                ->on("impuestos")
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
        Schema::drop('factura_impuesto');
    }
}
