<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    // create new book data 
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
        $createNewBook = Book::create([
            'bookcode' => $validated['bookcode'],
            'title' => $validated['title'],
            'year' => $validated['year'],
            'author' => $validated['author'],
            'stock' => $validated['stock'],
        ]);

        return response()->json([
            'success' => true,
            'message' => "Creating new book",
            'data' => $createNewBook
        ]);
    }

    // select all book
    public function index() {
        $books = Book::all();

        return response()->json([
            'success' => true,
            'message' => "Books retrieved successfully",
            'data' => $books
        ]);
    }

    // select book by id/code 
    public function show($bookcode) {
        // retrieve book by its valid code param
        $selectedBook = Book::where('bookcode', $bookcode)->first();

        if (!$selectedBook) {
            return response()->json([
                'success' => false,
                'message' => "Book not found",
            ]);
        }
        
        // return response 
        return response()->json([
            'success' => true,
            'message' => "Book retrieved successfully",
            'data' => $selectedBook
        ]);
    }

    // edit book 
    public function update(Request $request, $bookcode) {
        // select the book 
        $selectedBook = Book::where('bookcode', $bookcode)->first();

        if (!$selectedBook) {
            return response()->json([
                'success' => false,
                'message' => "Book not found",
            ], 404);
        }

        $validated = $request->validate([
            'bookcode' => 'sometimes|unique:books,bookcode,' . $selectedBook->id,
            'title'    => 'sometimes|string',
            'year'     => 'sometimes|numeric|min:1970',
            'author'   => 'sometimes|string',
            'stock'    => 'sometimes|integer|min:0',
        ]);

        // overwrite the data by request body
        $selectedBook->fill($validated)->save();

        return response()->json([
            'success' => true,
            'message' => "Book updated successfully",
            'data' => $selectedBook
        ]);
    }

    // delete book
    public function destroy($bookcode) {
         // select the book 
        $selectedBook = Book::where('bookcode', $bookcode)->first();

        if (!$selectedBook) {
            return response()->json([
                'success' => false,
                'message' => "Book not found",
            ], 404);
        }

        // delete the book 
        $selectedBook->delete();

        // return response
        return response()->json([
            'success' => true,
            'message' => 'Book deleted successfully',
        ]);
    }

    public function data () {
        $books = Book::select(['bookcode', 'title', 'author', 'year', 'stock']);

        return response()->json([
            'data' => $books->get()
        ]);
    }
}
