<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function stands()
    {
        return $this->belongsToMany('App\Stand');
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
