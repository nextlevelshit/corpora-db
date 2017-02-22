<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $fillable = array('title', 'description');

    public function texts()
    {
        return $this->hasMany('App\Text');
    }
}
