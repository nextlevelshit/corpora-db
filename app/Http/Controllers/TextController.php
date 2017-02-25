<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;
use App\State;
use App\Text;
use App\Notification;
use App\Http\Requests;
use Faker\Generator;

class TextController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create($id)
    {
        $entry = Entry::findOrFail($id);
        $states = State::all();

        return view('text.create', compact('entry', 'states'));
    }

    /**
    * Store a newly created text in storage and upload
    * file on server.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Requests\TextRequest $request, $id)
    {
        $entry = Entry::findOrFail($id);
        // get upload directory from environment variables
        $publicUploadDir = env('UPLOAD_PUBLIC', 'public/');
        $privateUploadDir = env('UPLOAD_PRIVATE', 'storage/');

        $file = $request->file('path');
        // rename uploaded file
        // TODO: better genrator for UUID
        $new['path'] = hash('sha256', time());
        $new['extension'] = $file->extension();
        // update input variables
        $input = $request->all();
        // store uploaded file and retrieve path
        $file->storeAs($publicUploadDir, implode($new, '.'));
        // store public path to database
        $input['path'] = $privateUploadDir . implode($new, '.');
        $input['entry_id'] = $id;

        try {
            $text = Text::create($input);
            $path = asset($input['path']);
            $notification = new Notification('Text erfolgreich importiert', 'Der importierte Text ist über folgende Adresse erreichbar:<br><a href="'.$path.'">'.$path.'</a>');
        } catch(Exception $e) {
            // save request data if error occured and fill form with input data
            $request->flash();
            // add notifcation including exception message
            $notification = new Notification('Text konnte nicht importiert werden', 'Bitte geben Sie folgende Nachricht an Ihren Administrator weiter: <blockquote>'.$e->getMessage().'</blockquote>');

        }

        $states = State::all();

        return view('text.create', compact('notification', 'states', 'entry'));
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Requests\TextRequest $request, $id)
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
