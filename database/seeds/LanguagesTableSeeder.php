<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'language_code'=>'es',
            'language' =>'Español',
        ]);

        DB::table('languages')->insert([
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'language_code'=>'en',
            'language' =>'Inglés',
        ]);

        DB::table('languages')->insert([
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'user_id'=>'1',
            'last_update_user_id'=>'1',
            'language_code'=>'fr',
            'language' =>'Francés',
        ]);
    }
}
