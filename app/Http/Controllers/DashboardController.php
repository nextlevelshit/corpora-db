<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entry;

class DashboardController extends Controller
{
    private $entriesOnDashboard = 20;

    public function showIndex()
    {
        // load a small collection of the last created entries for the dashboard
        $entries = Entry::orderBy('updated_at')->take($this->entriesOnDashboard)->get();

        return view('dashboard.index')->with('entries', $entries);

    }
}
