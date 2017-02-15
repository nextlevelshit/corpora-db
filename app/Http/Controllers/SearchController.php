<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showIndex()
    {
        return 'Suche';
    }

    public function showResults($data)
    {
        return;
    }
}
