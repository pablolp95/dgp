<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function last_update_user()
    {
        return $this->belongsTo('App\User','last_update_user_id');
    }
}
