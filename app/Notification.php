<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public $title;
    public $content;

    function __construct($title, $content)
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function title()
    {
        return $this->title;
    }

    public function content()
    {
        return $this->content;
    }
}
