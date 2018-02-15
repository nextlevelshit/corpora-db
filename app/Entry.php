<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\State;

class Entry extends Model
{
    use Searchable;

    protected $fillable = array('title', 'identifier', 'year', 'genre_id');

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
        return $this->belongsToMany('App\Author');
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

    public function textsLatest()
    {
        $states = State::all();
        $texts = [];
        // iterate through all given states
        foreach ($states as $state) {
            $text = $this->textByState($state->id);
            // pick only on text of each state
            if ($text) $texts[] = $text;
        }

        return $texts;
    }
}
