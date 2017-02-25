<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use Searchable;

    protected $fillable = array('title', 'identifier', 'year', 'genre_id', 'author_id');

    /**
    * Get the index name for the model.
    *
    * @return string
    */
    public function searchableAs()
    {
        return 'entries_index';
    }

    public function author()
    {
        return $this->belongsTo('App\Author');
    }

    public function genre()
    {
        return $this->belongsTo('App\Genre');
    }

    public function texts()
    {
        return $this->hasMany('App\Text');
    }

    public function textByState($state)
    {
        return $this->hasMany('App\Text')->latest()->where('texts.state_id', $state)->first();
    }
}
