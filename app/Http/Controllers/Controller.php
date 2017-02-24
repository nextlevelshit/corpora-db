<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Entry;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        View::share('latestEntries', Entry::latest()->take(5)->get());
        View::share('latestSearchRequests', '');
        // View::share('latestSearchRequests', Search::latest()->take(5)->get());
        View::share('latestExports', '');
        // View::share('latestExports', Export::latest()->take(5)->get());
    }
}
