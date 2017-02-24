<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    protected $fillable = array('path', 'content', 'state_id');

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
