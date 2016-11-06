<?php

use Illuminate\Database\Seeder;

class PresupuestoServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('presupuesto_servicio')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'servicio_id' => '1',
          'presupuesto_id' => '1',
      ]);

      DB::table('presupuesto_servicio')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'servicio_id' => '2',
          'presupuesto_id' => '1',
      ]);

      DB::table('presupuesto_servicio')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'servicio_id' => '2',
          'presupuesto_id' => '2',
      ]);


      DB::table('presupuesto_servicio')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'servicio_id' => '3',
          'presupuesto_id' => '3',
      ]);

      DB::table('presupuesto_servicio')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'servicio_id' => '4',
          'presupuesto_id' => '4',
      ]);
    }
}
