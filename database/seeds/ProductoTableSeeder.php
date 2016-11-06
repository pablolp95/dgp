<?php

use Illuminate\Database\Seeder;

class ProductoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('productos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Página web básica',
          'description' => 'Desarrollo de una página web básica',
          'price' => '399',
          //'img_url' => '',
          'development_time' => 'Dos semanas',
          'status' => 'Activo',
      ]);

      DB::table('productos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Página web básica con tienda',
          'description' => 'Desarrollo de una página web básica con tienda',
          'price' => '599',
          //'img_url' => '',
          'development_time' => '3 semanas',
          'status' => 'Activo',
      ]);

      DB::table('productos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Página web con diseño original',
          'description' => 'Desarrollo de una página web con diseño original',
          'price' => '999',
          //'img_url' => '',
          'development_time' => '1 mes y medio',
          'status' => 'Activo',
      ]);

      DB::table('productos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name' => 'Página web con diseño original y tienda',
          'description' => 'Página web con diseño original y tienda',
          'price' => '1799',
          //'img_url' => '',
          'development_time' => '2 meses',
          'status' => 'Activo',
      ]);
    }
}
