<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePresupuestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presupuestos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->index()->unsigned();
            $table->integer('proyecto_id')->index()->unsigned()->nullable();
            $table->integer('cliente_id')->index()->unsigned()->nullable();
            $table->integer('last_update_user_id')->index()->unsigned()->nullable();

            $table->string('r_invoicing_name')->nullable();
            $table->string('r_entity_type')->nullable();
            $table->string('r_nif',9)->nullable();
            $table->string('r_country',2)->nullable();
            $table->tinyInteger('r_state')->nullable();
            $table->string('r_city')->nullable();
            $table->string('r_zip_code',5)->nullable();
            $table->string('r_address_1')->nullable();
            $table->string('r_address_2')->nullable();

            $table->string('e_invoicing_name')->nullable();
            $table->string('e_entity_type')->nullable();
            $table->string('e_nif',9)->nullable();
            $table->string('e_country',2)->nullable();
            $table->tinyInteger('e_state')->nullable();
            $table->string('e_city')->nullable();
            $table->string('e_zip_code',5)->nullable();
            $table->string('e_address_1')->nullable();
            $table->string('e_address_2')->nullable();

            $table->integer('aceptation_days')->default(30)->unsigned();
            $table->integer('percentage_discount')->default(0)->unsigned();
            $table->decimal('amount_discount')->default(0)->unsigned();
            $table->text('notes');
        });

        Schema::table('presupuestos', function(Blueprint $table)
        {
            $table->foreign("user_id")
                ->references("id")
                ->on("users");
            $table->foreign("last_update_user_id")
                ->references("id")
                ->on("users");
        });

        Schema::table("facturas",function(Blueprint $table) {
            $table->foreign("presupuesto_id")
                ->references("id")
                ->on("presupuestos");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("facturas",function(Blueprint $table) {
            $table->dropForeign("facturas_presupuesto_id_foreign");
        });
        Schema::drop('presupuestos');
    }
}
