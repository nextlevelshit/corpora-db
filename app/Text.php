<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\State;

class Text extends Model
{
    protected $fillable = array('path');

    public function state()
    {
        return $this->hasOne('State');
    }
}
