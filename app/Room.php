<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $with = array('users');

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }
}
