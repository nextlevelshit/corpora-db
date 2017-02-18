<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;

class EntryController extends Controller
{
    public function create()
    {
        return view('entry.create');
    }

    public function save(Request $request)
    {
        $notification = new Notification('Eintrag gespeichert', 'Ihr Eintrag wurde erfolgreich gespeichert und ist unter folgender Adresse erreichbar: ');

        return view('entry.create')->with('notification', $notification);
    }
}
