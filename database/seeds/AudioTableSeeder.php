<?php

use Illuminate\Database\Seeder;

class AudioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('audio')->insert([
            'user_id' => '1',
            'last_update_user_id' => '1',
            'created_at' => Carbon\Carbon::now(),
            'updated_at' => Carbon\Carbon::now(),
            'name' => 'Ejemplo audio',
            'description' => 'Ejemplo descripción',
            'audio_url' => '',
        ]);
    }
}
