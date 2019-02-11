<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Author;
use App\Http\Requests;
use App\Http\Requests\AuthorRequest;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $authors = Author::orderBy('name', 'asc')->paginate(30);

        return view('author.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AuthorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AuthorRequest $request)
    {
        $input = $request->all();

        try {
            // create new entry including authors
            $author = Author::create($input);
            // add link to new author
            $link = route('author.show', $author->id);
            // add notifcation with new entry information
            $notification = new Notification('Autor*in erfolgreich erstellt', 'Ihr neuer Eintrag ist über folgende Adresse erreichbar: <a href="'.$link.'">'.$link.'</a>');
        } catch(Exception $e) {
            // add notifcation including exception message
            $notification = new Notification('Autor*in konnte nicht gespeichert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
        }

        return view('author.create', compact('notification'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author = Author::findOrFail($id);

        return view('author.show')->with('author', $author);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findOrFail($id);

        return view('author.edit', compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuthorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Requests\AuthorRequest $request, $id)
    {
        $author = Author::findOrFail($id);
        $input = $request->all();

        try {
            $author->update($input);
            $link = route('author.show', $author->id);
            // add notifcation with new entry information
            $notification = new Notification('Autor*in erfolgreich bearbeitet', 'Sie erreichen den neuen Eintrag über folgenden Link: <a href="'.$link.'">'.$link.'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flashExcept(['author']);
            // add notifcation including exception message
            $notification = new Notification('Autor*in konnte nicht gespeichert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: <blockquote>'.$e->getMessage().'</blockquote>');
        }

        return view('author.edit', compact('notification', 'author'));
    }

    /**
     * Search for authors and return a JSON list
     *
     * @param  string $searchTerm
     * @return \Illuminate\Http\Response
     */
    public function search($searchTerm)
    {
        return response()->json(
            Author::search($searchTerm)
                ->get()
                ->sortBy('name')
                ->all()
        );
    }
}
