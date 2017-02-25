<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;
use App\State;
use App\Http\Requests;
use Carbon\Carbon;
// use Chumper\Zipper\Zipper;

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

        $input = $request->all();
        $exports = array();

        foreach ($input['entries'] as $id) {
            $entry = Entry::findOrFail($id);

            foreach ($input['states'] as $state) {
                $text = $entry->textByState($state);

                if ($text && file_exists($text)) $exports[] = $text->path;
            }
        }
        $title['app'] = str_slug(config('app.name'));
        $title['term'] = str_slug($input['term']);
        $title['date'] = Carbon::now()->format('Ymd');

        $exportFileName = 'storage/' . implode('_', $title) . '.zip';

        $zipper = new \Chumper\Zipper\Zipper;

        try {
            $exportFile = $zipper->make($exportFileName)->add($exports);
            $exportFile->close();

            return response()->download($exportFileName);
        } catch (Exception $e) {
            unset($e);
        }
    }
}
