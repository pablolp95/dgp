<?php

use Illuminate\Database\Seeder;

class ProyectoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('proyectos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'client_id' => '1',
          'name' => 'Software para la gestión código javascript',
          //'img_url' => '',
          'starting_date' => Carbon\Carbon::now(),
          'ending_date' => Carbon\Carbon::now(),
          'notes' => 'Desarrollo de una página web básica.',
      ]);

      DB::table('proyectos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'client_id' => '2',
          'name' => 'Proyecto secreto',
          //'img_url' => '',
          'starting_date' => Carbon\Carbon::now(),
          'ending_date' => Carbon\Carbon::now(),
          'notes' => 'Software para lograr la dominación mundial.',
      ]);

      DB::table('proyectos')->insert([
          'user_id' => '3',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'client_id' => '3',
          'name' => 'PYME App',
          //'img_url' => '',
          'starting_date' => Carbon\Carbon::now(),
          'ending_date' => Carbon\Carbon::now(),
          'notes' => 'Aplicación web para gestión de PYME.',
      ]);

      DB::table('proyectos')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'client_id' => '4',
          'name' => 'Plugin para JavaScript',
          //'img_url' => '',
          'starting_date' => Carbon\Carbon::now(),
          'ending_date' => Carbon\Carbon::now(),
          'notes' => 'Plugin para agilizar el desarrollo de scripts.',
      ]);



    }
}
