<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    public function stand()
    {
        return $this->belongsTo('App\Stand');
    }

    public function language()
    {
        return $this->belongsTo('App\Language');
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
