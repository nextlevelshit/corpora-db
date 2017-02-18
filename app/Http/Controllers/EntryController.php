<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function create()
    {
        return view('entry.create');
    }

    public function save(Request $request)
    {
//        $notification = array('title' => 'Eintrag gespeichert', 'content' => 'Ihr Eintrag wurde erfolgreich gespeichert und ist unter folgender Adresse erreichbar: ');
//        $notification;
//        return view('entry.create')->with('notification', $notification);
        return view('entry.create');
    }
}
