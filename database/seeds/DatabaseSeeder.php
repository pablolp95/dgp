<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
	      $this->call(ClienteTableSeeder::class);
        $this->call(FacturaTableSeeder::class);
        $this->call(ImpuestoTableSeeder::class);
        $this->call(PresupuestoTableSeeder::class);
        $this->call(ProductoTableSeeder::class);
        $this->call(ProyectoTableSeeder::class);
        $this->call(ServicioTableSeeder::class);
        $this->call(FacturaImpuestoTableSeeder::class);
        $this->call(FacturaProductoTableSeeder::class);
        $this->call(FacturaServicioTableSeeder::class);
        $this->call(PresupuestoProductoTableSeeder::class);
        $this->call(PresupuestoServicioTableSeeder::class);

        Model::reguard();
    }
}
