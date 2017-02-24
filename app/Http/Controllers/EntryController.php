<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;
use App\Author;
use App\Genre;
use App\Http\Requests;
use Requests\CreateEntryRequest;

class EntryController extends Controller
{
    // add new entry


    public function add()
    {
        $genres = Genre::orderBy('title')->get();

        // TODO: add author to form after validation fail

        return view('entry.add', compact('genres'));
    }

    // show details of specific entry
    public function details($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.details', compact('entry'));
    }

    // edit specific entry
    public function edit($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.edit', compact('entry'));
    }

    // save added or edited entry
    public function save(Requests\CreateEntryRequest $request)
    {
        $input = $request->all();

        // check if author already exists, otherwise create new one
        if (empty($request->input('author_id')) && !empty($request->input('author'))) {
            try {
                $author = Author::create(['name' => $input['author']]);
                // add author id to entry model
                $input['author_id'] = $author->id;
            } catch(Exception $e) {
                // save request data if error occured and fill form with input data
                $request->flashExcept(['author_id', 'author']);
                // add notifcation including exception message
                $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Sie haben versucht einen neuen Autor hinzuzufügen. Bitte geben Sie folgende Nachricht an Ihren Administator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
            }
        } else {
            // switch author name to id of entry model
            $input['author_id'] = $input['author_id'];
        }

        try {
             $entry = Entry::create($input);
             $notification = new Notification('Eintrag erfolgreich erstellt', 'Ihr neuer Eintrag ist über folgende Adresse erreichbar: <a href="'.route('entry.details', $entry->id).'">'.route('entry.details', $entry->id).'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flashExcept(['author_id', 'author']);
            // add notifcation including exception message
            $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: '.$e->getMessage().'</blockquote>');
        }

        $genres = Genre::orderBy('title')->get();

        return view('entry.add', compact('notification', 'genres'));
    }
}
