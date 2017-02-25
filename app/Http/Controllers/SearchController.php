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

    private function generateExportFileName($parts)
    {
        return 'storage/' . implode('_', $parts) . '.zip';
    }

    public function export(Requests\ExportRequest $request)
    {

        $input = $request->all();
        $exports = array();

        $title['app'] = str_slug(config('app.name'));
        $title['term'] = str_slug($input['term']);
        $title['date'] = Carbon::now()->format('Ymd');

        $exportFileName = $this->generateExportFileName($title);

        for ($title['version']=1; file_exists($exportFileName); $title['version']++) {
            $exportFileName = $this->generateExportFileName($title);
        }

        $zipper = new \Chumper\Zipper\Zipper;
        $zipper->make($exportFileName);

        foreach ($input['entries'] as $id) {
            $entry = Entry::findOrFail($id);

            foreach ($input['states'] as $state) {
                $text = $entry->textByState($state);

                if ($text && file_exists($text->path)) {
                    $file['author'] = str_slug($entry->author->name);
                    $file['title'] = str_slug($entry->title);
                    $file['state'] = str_slug($text->state->title);
                    $file['year'] = $entry->year;

                    $fileName = implode('_', $file) . '.txt';
                    $fileContent = file_get_contents($text->path);

                    $zipper->addString($fileName, $fileContent);

                    unset($file);
                }
            }
        }

        try {
            // $exportFile = $zipper->make($exportFileName)->add($exports);
            $zipper->close();

            return response()->download($exportFileName);
        } catch (Exception $e) {
            unset($e);
        }
    }
}
