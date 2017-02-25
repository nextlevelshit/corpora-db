<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;
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

    public function export(Requests\ExportRequest $request)
    {
        // return response()->download('storage/190b07515e84cb724cfdbc66aa24e7dc6cc6f831e68130666a396982d318f003.txt');

        // dd($request->all());

        $input = $request->all();
        $exports = array();

        foreach ($input['entries'] as $id) {
            $entry = Entry::findOrFail($id);

            foreach ($input['states'] as $state) {
                $text = $entry->textByState($state);

                if ($text) $exports[] = $text->path;
            }
        }

        dd($exports);

        return false;
    }
}
