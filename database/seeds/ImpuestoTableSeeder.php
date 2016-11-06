<?php

use Illuminate\Database\Seeder;

class ImpuestoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('impuestos')->insert([
          'user_id'=>'1',
          'last_update_user_id'=>'1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          'name'=>'IVA',
          'aplicable_to_all' => '1',
          'fixed_amount' => '0.0',
          'percentage' => '21'
      ]);
    }
}
