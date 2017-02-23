<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

class AuthorController extends Controller
{
    public function details($id)
    {
        $author = Author::findOrFail($id);

        return view('author.details')->with('author', $author);
    }

    public function search($searchTerm)
    {
        return array(Author::search($searchTerm)->get());
    }
}
