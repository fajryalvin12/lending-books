<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $books = [
            [
                'bookcode' => 'BK001',
                'title' => 'Clean Code',
                'year' => 2008,
                'author' => 'Robert C. Martin',
                'stock' => 10,
            ],
            [
                'bookcode' => 'BK002',
                'title' => 'The Pragmatic Programmer',
                'year' => 1999,
                'author' => 'Andrew Hunt',
                'stock' => 8,
            ],
            [
                'bookcode' => 'BK003',
                'title' => 'Design Patterns',
                'year' => 1994,
                'author' => 'Erich Gamma',
                'stock' => 5,
            ],
            [
                'bookcode' => 'BK004',
                'title' => 'Refactoring',
                'year' => 1999,
                'author' => 'Martin Fowler',
                'stock' => 7,
            ],
            [
                'bookcode' => 'BK005',
                'title' => 'You Don’t Know JS',
                'year' => 2015,
                'author' => 'Kyle Simpson',
                'stock' => 12,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        };
    }
}
