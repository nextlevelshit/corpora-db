<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use App\Entry;

class EntryController extends Controller
{
    // add new entry
    public function add()
    {
        return view('entry.add');
    }

    // show details of specific entry
    public function details($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.details')->with('entry', $entry);
    }

    // edit specific entry
    public function edit($id)
    {
        $entry = Entry::findOrFail($id);

        return view('entry.edit')->with('entry', $entry);
    }

    // save added or edited entry
    public function save(Request $request)
    {
        $notification = new Notification('Eintrag gespeichert', 'Ihr Eintrag wurde erfolgreich gespeichert und ist unter folgender Adresse erreichbar: ');

        return view('entry.create')->with('notification', $notification);
    }
}
