<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=>'superadmin',
            'email'=>'superadmin@gmail.com',
            'password'=>bcrypt('dgp'),
            'remember_token' =>str_random(10),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        $user = App\User::where('email', '=', 'superadmin@gmail.com')->first();
        $user->attachRole(1);

        DB::table('users')->insert([
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>bcrypt('dgp'),
            'remember_token' =>str_random(10),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        $user = App\User::where('email', '=', 'admin@gmail.com')->first();
        $user->attachRole(2);

        DB::table('users')->insert([
            'name'=>'empleado',
            'email'=>'empleado@gmail.com',
            'password'=>bcrypt('dgp'),
            'remember_token' =>str_random(10),
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
        ]);

        $user = App\User::where('email', '=', 'empleado@gmail.com')->first();
        $user->attachRole(3);
        
    }
}
