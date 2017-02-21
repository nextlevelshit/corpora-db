<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    protected $fillable = array('title', 'identifier', 'year', 'genre_id', 'author_id');

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }
}
