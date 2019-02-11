<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;

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


    public function details($id)
    {
        $author = Author::findOrFail($id);

        return view('author.details')->with('author', $author);
    }

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
