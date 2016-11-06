<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int|null user_id
 */
class Proyecto extends Model
{
    public function presupuestos()
    {
        return $this->hasMany('App\Presupuesto');
    }

    public function facturas()
    {
        return $this->hasMany('App\Factura');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'client_id');
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
