<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function showIndex()
    {
        return view('search.index');
    }

    public function showResults($data)
    {
        return view('search.results');
    }
}
