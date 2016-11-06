<?php

use Illuminate\Database\Seeder;

class FacturaProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('factura_producto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'producto_id' => '1',
          'factura_id' => '1',
      ]);

      DB::table('factura_producto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'producto_id' => '2',
          'factura_id' => '1',
      ]);

      DB::table('factura_producto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'producto_id' => '2',
          'factura_id' => '2',
      ]);


      DB::table('factura_producto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'producto_id' => '3',
          'factura_id' => '3',
      ]);

      DB::table('factura_producto')->insert([
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'producto_id' => '4',
          'factura_id' => '4',
      ]);
    }
}
