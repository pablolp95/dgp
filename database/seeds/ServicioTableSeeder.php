<?php

use Illuminate\Database\Seeder;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('servicios')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Mantenimiento basica',
          'description' => 'Mantenimiento de una página web básica',
          'price' => '49',
          //'img_url' => '',
          'development_time' => 'Dos semanas',
          'invoice_period' => '6',
          'status' => 'Activo',
      ]);

      DB::table('servicios')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Mantenimiento basic & shop',
          'description' => 'Mantenimiento de una página web básica con tienda',
          'price' => '99',
          //'img_url' => '',
          'development_time' => '3 semanas',
          'invoice_period' => '9',
          'status' => 'Activo',
      ]);

      DB::table('servicios')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Mantenimiento original',
          'description' => 'Mantenimiento de una página web con diseño original',
          'price' => '149',
          //'img_url' => '',
          'development_time' => '1 mes y medio',
          'invoice_period' => '12',
          'status' => 'Activo',
      ]);

      DB::table('servicios')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Mantenimiento original & shop',
          'description' => 'Mantenimiento página web con diseño original y tienda',
          'price' => '199',
          //'img_url' => '',
          'development_time' => '2 meses',
          'invoice_period' => '16',
          'status' => 'Activo',
      ]);
    }
}
