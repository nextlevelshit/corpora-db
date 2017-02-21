<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $fillable = array('title');

    public function entries()
    {
        // $this->belongsToMany('Entry');
    }
}
