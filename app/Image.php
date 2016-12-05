<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public function stand()
    {
        return $this->belongsTo('App\Stand');
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
