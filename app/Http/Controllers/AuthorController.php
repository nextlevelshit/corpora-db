<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function showDetails($id)
    {
        $author = Author::findOrFail($id);

        return view('author.details')->with('author', $author);
    }
}
