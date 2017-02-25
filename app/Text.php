<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Text extends Model
{
    use Searchable;

    public $result;

    protected $fillable = array('path', 'comment', 'state_id', 'entry_id');

    /**
    * Get the index name for the model.
    *
    * @return string
    */
    public function searchableAs()
    {
        return 'texts_index';
    }

    public function state()
    {
        return $this->belongsTo('App\State');
    }

    public function entry()
    {
        return $this->belongsTo('App\Entry');
    }
    /**
     * Set found corresponding line inside text file from search results
     * @param string $line
     */
    public function setResultAttribute($line)
    {
        $this->result = $line;
    }
    /**
     * Get corresponding line from search results inside text file
     * @return string
     */
    public function getResultAttribute()
    {
        return $this->result;
    }
}
