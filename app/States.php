<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Text;

class States extends Model
{
    protected $fillable = array('title', 'description');

    public function texts()
    {
        // return $this->belongsToMany('Text');
    }
}
