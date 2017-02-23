<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use Searchable;

    protected $fillable = array('name', 'year');

    /**
    * Get the index name for the model.
    *
    * @return string
    */
    public function searchableAs()
    {
        return 'authors_index';
    }
    
    public function entries()
    {
        return $this->hasMany('App\Entry');
    }
}
