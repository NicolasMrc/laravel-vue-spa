<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $with = array('user');

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
