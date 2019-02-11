<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Author;
use App\Entry;
use App\State;
use App\Text;
use App\Http\Requests;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function advanced() {
        $states = State::all();
        $term = '';

        return view('search.results', compact('search', 'states'));
    }

    public function results(Request $request)
    {
        $search = $request->all();
        $term = $search['term'];
        $states = State::all();
        // search entries with scout
        // search authors with scout
        $entries = Entry::search($term)->get();
        $authors = Author::search($term)->get();
        // add placeholder for texts
        $texts = [];
        // search texts by reading contents
        foreach (Text::all() as $text) {
            // break if file does not exist
            if (!file_exists($text->path)) break;
            // reading file
            $handle = fopen($text->path, 'r');
            // count lines
            $line = 0;
            // init as false
            $valid = false;
            while (($buffer = fgets($handle)) !== false) {
                if (strpos($buffer, $term) !== false) {
                    // searched successfully
                    $valid = true;
                    // add search result to list
                    $text->result = $this->getSurroundingLines(file($text->path), $line);
                    // dd(file($text->path)[$line]);
                    $texts[] = $text;
                    // break loop after successfully found to save memory
                    break;
                }
                $line++;
            }
            // close file after reading
            fclose($handle);
        }
        // count results
        $results = count($entries) + count($authors) + count($texts);

        return view('search.results', compact('term', 'entries', 'states', 'authors', 'results', 'texts'));
    }

    private function generateExportFileName($parts)
    {
        return 'storage/' . implode('_', $parts) . '.zip';
    }

    public function export(Requests\ExportRequest $request)
    {
        $input = $request->all();
        $term = $input['term'];
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
	            //$file['author'] = str_slug($entry->author->name);
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
            $zipper->close();
            if (file_exists($exportFileName)) {
                return response()->download($exportFileName);
            } else {
                return redirect()
                    ->back()
                    ->withErrors(
                        array(
                            'message' => 
                                'Der gewünschte Export enthielt leider keine Dateien. Bitte überprüfen Sie, ob die ausgewählten Einträge auch die gewünschten Texte enthalten.'
                        )
                    )
                    ->withInput();
            }
        } catch(Exception $e) {
            dd('not');
            return back()->withInput()->withErrors(['Es ist zu einem unerwarteten Fehler gekommen. Bitte versuchen Sie es erneut.']);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Functions
    |--------------------------------------------------------------------------
    */

   private function getSurroundingLines($file, $line) {
       $output = $file[$line];

       if ($line == 0) {
           if (!isset($file[$line + 2])) return $output;

           return $output . $file[$line + 1] . $file[$line + 2];
       }

       return $file[$line - 1] . $output . $file[$line + 1];
   }
}
