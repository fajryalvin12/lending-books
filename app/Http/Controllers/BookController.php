<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    //
    public function store (Request $request) {
        // validate body request 
        $validated = $request->validate([
            'bookcode' => 'required|unique:books,bookcode',
            'title' => 'required',
            'year' => 'required|min:1970|numeric',
            'author' => 'required',
            'stock' => 'required|min:0|integer',
        ]);

        // send to models 
        $book = Book::create([
            'bookcode' => $validated['bookcode'],
            'title' => $validated['title'],
            'year' => $validated['year'],
            'author' => $validated['author'],
            'stock' => $validated['stock'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Creating new book",
            'data' => $book
        ]);
    }

    // select all book
    public function index() {

    }

    // select book by id/code 
    public function show() {

    }

    // edit book 
    public function update() {

    }

    // delete book
    public function delete() {

    }
}
