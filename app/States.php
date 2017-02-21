<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class States extends Model
{
    protected $fillable = array('title', 'description');
}
