<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public static $modes = [
        'hearing_loss' => 'Discapacidad auditiva',
        'no_hearing_loss' => 'Sin discapacidad auditiva'
    ];

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
