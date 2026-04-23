<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    // borrow the book (POST method)
    public function borrowed (Request $request) {
        
        // retrieve book by its valid code param
        $bookcode = $request->bookcode;
        $selectedBook = Book::where('bookcode', $bookcode)->first();
        
        if (!$selectedBook) {
            return response()->json([
                'success' => false,
                'message' => "Book not found",
            ]);
        }

        // check the stock avaliability
        $stock = $selectedBook->stock;
        $bookID = $selectedBook->id;
        if ($stock <= 0 ) {
            return response()->json([
                'success' => false,
                'message' => "Cannot borrowed the book",
            ]);
        };

        // init DB transaction before create new borrowing
        try {
            DB::beginTransaction();

            DB::table('books')->where('bookcode', $bookcode)->decrement('stock', 1);

            $borrowed = DB::table('borrowings')->insert([
                'book_id' => $bookID,
                'borrow_date' => date('Y-m-d H:i:s'),
                'return_date' => null,
                'status' => "pending"
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => "Creating new book",
                'data' => $borrowed
            ]);
        } catch (\Exception $e) {
            report($e);

            DB::rollBack();
        }
    }

    // return the book (PUT method)
    public function returned () {

    }
}
