<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    public function facturas()
    {
        return $this->hasMany('App\Factura');
    }

    public function productos()
    {
        return $this->belongsToMany('App\Producto');
    }

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function last_update_user()
    {
        return $this->belongsTo('App\User','last_update_user_id');
    }
}
