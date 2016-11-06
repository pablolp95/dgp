<?php

use Illuminate\Database\Seeder;

class FacturaImpuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('factura_impuesto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'impuesto_id' => '1',
          'factura_id' => '1',
      ]);

      DB::table('factura_impuesto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'impuesto_id' => '1',
          'factura_id' => '2',
      ]);

      DB::table('factura_impuesto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'impuesto_id' => '1',
          'factura_id' => '3',
      ]);

      DB::table('factura_impuesto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'impuesto_id' => '1',
          'factura_id' => '4',
      ]);
    }
}
