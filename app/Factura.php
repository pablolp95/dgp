<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed productos
 * @property mixed servicios
 * @property mixed percentage_discount
 * @property mixed amount_discount
 * @property mixed impuestos
 */
class Factura extends Model
{
    public function productos()
    {
        return $this->belongsToMany('App\Producto');
    }

    public function servicios()
    {
        return $this->belongsToMany('App\Servicio');
    }

    public function impuestos()
    {
        return $this->belongsToMany('App\Impuesto');
    }

    public function cliente()
    {
        return $this->belongsTo('App\Cliente');
    }

    public function proyecto()
    {
        return $this->belongsTo('App\Proyecto');
    }

    public function presupuesto()
    {
        return $this->belongsTo('App\Presupuesto');
    }

    public function last_update_user()
    {
        return $this->belongsTo('App\User','last_update_user_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
