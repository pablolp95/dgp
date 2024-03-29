<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stand extends Model
{
    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function audio()
    {
        return $this->hasMany('App\Audio');
    }

    public function videos()
    {
        return $this->hasMany('App\Video');
    }

    public function texts()
    {
        return $this->hasMany('App\Text');
    }

    public function zones()
    {
        return $this->belongsTo('App\Zone');
    }

    public function routes()
    {
        return $this->belongsTo('App\Route');
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
