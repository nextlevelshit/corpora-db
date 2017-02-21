<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = array('title', 'identifier', 'author_id', 'genre_id', 'year');
}
