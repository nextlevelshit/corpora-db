<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Genre;

class Entry extends Model
{
    protected $fillable = array('title', 'identifier', 'year');

    public function genre()
    {
        return $this->hasOne('Genre');
    }
}
