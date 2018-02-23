<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;
use App\Author;
use App\Genre;
use App\Http\Requests;
use App\Http\Requests\EntryRequest;

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

        return view('entry.index', compact('entries'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $genres = Genre::orderBy('title')->get();

        return view('entry.create', compact('genres'));
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Requests\EntryRequest $request)
    {
       
        $input = $request->all();
        $authors = json_decode($request->input('author'));
        $authorsIds = [];

        foreach($authors as $author) {
            if (empty($author->id)) {
                try {
                    $authorsIds[] = Author::create((array) $author)->id;
                } catch(Exception $e) {
                    // save request data if error occured and fill form with input data
                    $request->flashExcept(['author']);
                    // add notifcation including exception message
                    $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Sie haben versucht einen neuen Autor hinzuzufügen. Bitte geben Sie folgende Nachricht an Ihren Administator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
                }
            } else {
                $authorsIds[] = $author->id;
            }
        }

        try {
            // create new entry including authors
            $entry = Entry::create($input);
            $entry->author()->attach($authorsIds);
            // add link to new entry
            $link = route('entry.show', $entry->id);
            // add notifcation with new entry information
            $notification = new Notification('Eintrag erfolgreich erstellt', 'Ihr neuer Eintrag ist über folgende Adresse erreichbar: <a href="'.$link.'">'.$link.'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flashExcept(['author']);
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
        $genres = Genre::orderBy('title')->get();

        return view('entry.edit', compact('entry', 'genres'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Requests\EntryRequest $request, $id)
    {
        $entry = Entry::findOrFail($id);
        $input = $request->all();
        $authors = json_decode($request->input('author'));
        $authorsIds = [];

        foreach($authors as $author) {
            if (empty($author->id)) {
                try {
                    $authorsIds[] = Author::create((array) $author)->id;
                } catch(Exception $e) {
                    // save request data if error occured and fill form with input data
                    $request->flashExcept(['author']);
                    // add notifcation including exception message
                    $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Sie haben versucht einen neuen Autor hinzuzufügen. Bitte geben Sie folgende Nachricht an Ihren Administator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
                }
            } else {
                $authorsIds[] = $author->id;
            }
        }

        // dd($entry['fillable']);
        // dd($input);

        try {
            $entry->update($input);
            $entry->author()->sync($authorsIds);
            $link = route('entry.show', $entry->id);
            // add notifcation with new entry information
            $notification = new Notification('Eintrag erfolgreich bearbeitet', 'Ihr neuer Eintrag ist über folgende Adresse erreichbar: <a href="'.$link.'">'.$link.'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flashExcept(['author']);
            // add notifcation including exception message
            $notification = new Notification('Eintrag konnte nicht gespeichert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
        }

        $genres = Genre::orderBy('title')->get();

        return view('entry.edit', compact('notification', 'entry', 'genres'));
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
