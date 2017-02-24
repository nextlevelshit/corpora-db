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
    private $entriesOnDashboard = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $entries = Entry::latest()->take($this->entriesOnDashboard)->get();

        return view('entry.index')->with('entries', $entries);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // TODO: add author to form after validation fail

        $genres = Genre::orderBy('title')->get();

        return view('entry.create', compact('genres'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Requests\CreateEntryRequest $request)
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
            $link = route('entry.show', $entry->id);
            $notification = new Notification('Eintrag erfolgreich erstellt', 'Ihr neuer Eintrag ist über folgende Adresse erreichbar: <a href="'.$link.'">'.$link.'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flashExcept(['author_id', 'author']);
            // add notifcation including exception message
            $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
        }

        $genres = Genre::orderBy('title')->get();

        return view('entry.create', compact('notification', 'genres'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.show', compact('entry'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.edit', compact('entry'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }
}
