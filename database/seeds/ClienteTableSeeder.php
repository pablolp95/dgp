<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clientes')->insert([
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'name'=>'Valentín',
            'surname'=>'Pedrosa',
            'nif'=>'12345678M',
            'country'=>'España',
            'city'=>'Granada',
            'zip_code'=>'18012',
            'address_1'=>'Calle aleatoria Nº1',
            'phone'=>'123456789',
            'mobile'=>'123456789',
            'email'=>'valentin@correo.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        DB::table('clientes')->insert([
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'name'=>'Ramón',
            'surname'=>'Sanchez',
            'nif'=>'12345679M',
            'country'=>'España',
            'city'=>'Granada',
            'zip_code'=>'18012',
            'address_1'=>'Calle aleatoria Nº1',
            'phone'=>'123456789',
            'mobile'=>'123456789',
            'email'=>'ramon@correo.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        DB::table('clientes')->insert([
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'name'=>'Jose',
            'surname'=>'Conejero',
            'nif'=>'12345677M',
            'country'=>'España',
            'city'=>'Granada',
            'zip_code'=>'11300',
            'address_1'=>'Calle aleatoria Nº1',
            'phone'=>'123456789',
            'mobile'=>'123456789',
            'email'=>'jose@correo.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        DB::table('clientes')->insert([
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'name'=>'Pablo',
            'surname'=>'Lara',
            'nif'=>'12345668M',
            'country'=>'España',
            'city'=>'La Linea',
            'zip_code'=>'11300',
            'address_1'=>'Calle aleatoria Nº1',
            'phone'=>'123456789',
            'mobile'=>'123456789',
            'email'=>'pablo@correo.com',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);
    }
}
