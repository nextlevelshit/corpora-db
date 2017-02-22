<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = array('path');

    public function state()
    {
        return $this->hasOne('App\State');
    }
}
