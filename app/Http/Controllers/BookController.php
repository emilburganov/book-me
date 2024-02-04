<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $books = Book::query();

        if (isset($request->author)) {
            $books->where('author_id', $request->author);
        }

        if (isset($request->genres)) {
            $genres = $request->genres;

            $books->whereHas('genres', function($query) use ($genres) {
                $query->whereHas('books', function($q) use ($genres){
                    $q->whereIn('genres.id', $genres);
                });
            });
        }


        if (isset($request->sorting)) {
            $books->orderBy('created_at', $request->sorting);
        }

        $books = $books->paginate(8);

        $genres = Genre::all();
        $authors = Author::all();

        return view('books', compact(['books', 'genres', 'authors']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if (Auth::user()) {
            $isSelected = Auth::user()
                ->books()
                ->where('book_id', $book->id)
                ->exists();
        } else {
            $isSelected = false;
        }

        return view('book', compact(['book', 'isSelected']));
    }

    public function addToSelected(Book $book)
    {
        $user = Auth::user();

        $user->books()->attach($book->id);

        return redirect()->back();
    }

    public function removeFromSelected(Book $book)
    {
        $user = Auth::user();

        $user->books()->detach($book->id);

        return redirect()->back();
    }

    public function removeAllFromSelected()
    {
        $user = Auth::user();

        $user->books()->sync([]);

        return redirect()->back();
    }

    public function showSelected()
    {
        $user = Auth::user();

        $books = $user->books;

        return view('selected', compact(['books']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        //
    }
}
