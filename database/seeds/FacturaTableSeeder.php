<?php

use Illuminate\Database\Seeder;

class FacturaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('facturas')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          //'proyecto_id' => '1',
          //'presupuesto' => '1',
          //'cliente_id' => '1',
          'r_invoicing_name' => 'Valentin',
          //'r_entity_type' => '',
          'r_nif' => '11037013A',
          'r_country' => 'ES',
          'r_state' => '2',
          'r_city' => 'Granada',
          'r_zip_code' => '18012',
          'r_address_1' => 'Calle aleatorio nº1',
          'e_invoicing_name' => 'Raul',
          //'e_entity_type' => '',
          'e_nif' => '59713534Z',
          'e_country' => 'ES',
          'e_state' => '2',
          'e_city' => 'Granada',
          'e_zip_code' => '18012',
          'e_address_1' => 'Calle aleatorio nº2',
          'aceptation_days' => '10',
          'percentage_discount' => '9',
          'amount_discount' => '0',
          'notes' => 'Ejemplo de factura'
      ]);

      DB::table('facturas')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          //'proyecto_id' => '1',
          //'presupuesto' => '1',
          //'cliente_id' => '1',
          'r_invoicing_name' => 'Ramón',
          //'r_entity_type' => '',
          'r_nif' => '91962932P',
          'r_country' => 'ES',
          'r_state' => '2',
          'r_city' => 'Granada',
          'r_zip_code' => '18012',
          'r_address_1' => 'Calle aleatorio nº1',
          'e_invoicing_name' => 'Raul',
          //'e_entity_type' => '',
          'e_nif' => '59713534Z',
          'e_country' => 'ES',
          'e_state' => '2',
          'e_city' => 'Granada',
          'e_zip_code' => '18012',
          'e_address_1' => 'Calle aleatorio nº2',
          'aceptation_days' => '10',
          'percentage_discount' => '9',
          'amount_discount' => '0',
          'notes' => 'Ejemplo de factura 2'
      ]);

      DB::table('facturas')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          //'proyecto_id' => '1',
          //'presupuesto' => '1',
          //'cliente_id' => '1',
          'r_invoicing_name' => 'Jose',
          //'r_entity_type' => '',
          'r_nif' => '19206590A',
          'r_country' => 'ES',
          'r_state' => '2',
          'r_city' => 'Granada',
          'r_zip_code' => '18012',
          'r_address_1' => 'Calle aleatorio nº3',
          'e_invoicing_name' => 'Raul',
          //'e_entity_type' => '',
          'e_nif' => '59713534Z',
          'e_country' => 'ES',
          'e_state' => '2',
          'e_city' => 'Granada',
          'e_zip_code' => '18012',
          'e_address_1' => 'Calle aleatorio nº2',
          'aceptation_days' => '10',
          'percentage_discount' => '9',
          'amount_discount' => '0',
          'notes' => 'Ejemplo de factura'
      ]);

      DB::table('facturas')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          //'proyecto_id' => '1',
          //'presupuesto' => '1',
          //'cliente_id' => '1',
          'r_invoicing_name' => 'Pablo',
          //'r_entity_type' => '',
          'r_nif' => '54654106B',
          'r_country' => 'ES',
          'r_state' => '2',
          'r_city' => 'Granada',
          'r_zip_code' => '18012',
          'r_address_1' => 'Calle aleatorio nº3',
          'e_invoicing_name' => 'Raul',
          //'e_entity_type' => '',
          'e_nif' => '59713534Z',
          'e_country' => 'ES',
          'e_state' => '2',
          'e_city' => 'Granada',
          'e_zip_code' => '18012',
          'e_address_1' => 'Calle aleatorio nº2',
          'aceptation_days' => '10',
          'percentage_discount' => '9',
          'amount_discount' => '0',
          'notes' => 'Ejemplo de factura'
      ]);

      DB::table('facturas')->insert([
          'user_id' => '1',
          'last_update_user_id' => '1',
          'created_at' => Carbon\Carbon::now(),
          'updated_at' => Carbon\Carbon::now(),
          //'proyecto_id' => '1',
          //'presupuesto' => '1',
          //'cliente_id' => '1',
          'r_invoicing_name' => 'Jose Manuel',
          //'r_entity_type' => '',
          'r_nif' => '54654106B',
          'r_country' => 'ES',
          'r_state' => '2',
          'r_city' => 'Granada',
          'r_zip_code' => '18012',
          'r_address_1' => 'Calle aleatorio nº1',
          'e_invoicing_name' => 'Raul',
          //'e_entity_type' => '',
          'e_nif' => '59713534Z',
          'e_country' => 'ES',
          'e_state' => '2',
          'e_city' => 'Granada',
          'e_zip_code' => '18012',
          'e_address_1' => 'Calle aleatorio nº2',
          'aceptation_days' => '10',
          'percentage_discount' => '9',
          'amount_discount' => '0',
          'notes' => 'Ejemplo de factura'
      ]);
    }
}
