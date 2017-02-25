<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;
use App\Author;
use App\State;
use App\Http\Requests;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function results(Request $request)
    {
        $search = $request->all();

        $entries = Entry::search($search['term'])->get();
        $states = State::all();

        // dd($results);

        return view('search.results', compact('search', 'entries', 'states'));
    }

    public function export(Request $request)
    {
        dd($request->all());
        return false;
    }
}
