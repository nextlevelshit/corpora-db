<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Entry;

class Author extends Model
{
    protected $fillable = array('name', 'year');

    public function entries()
    {
        return $this->belongsToMany('Entry');
    }
}
