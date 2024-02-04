<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $genres = Genre::all();
        $authors = Author::all();
        $users = User::all();

        return view('admin', compact(['books', 'genres', 'authors', 'users']));
    }

    public function storeGenres(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
        ]);

        if (!$v->fails()) {
            Genre::query()->create([
                'name' => $request->name
            ]);
        }

        return redirect()->back();
    }

    public function deleteGenres(Genre $genre)
    {
        $genre->delete();

        return redirect()->back();
    }

    public function storeAuthors(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'surname' => 'required|string',
            'patronymic' => 'required|string',
        ]);

        if (!$v->fails()) {
            Author::query()->create([
                'name' => $request->name,
                'surname' => $request->surname,
                'patronymic' => $request->patronymic,
            ]);
        }

        return redirect()->back();
    }

    public function deleteAuthors(Author $author)
    {
        $author->delete();

        return redirect()->back();
    }

    public function storeBooks(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string',
            'description' => 'required|string',
            'is_shown' => 'required|boolean',
            'image' => 'required|image',
            'author' => 'required|integer',
        ]);

        if (!$v->fails()) {
            $book = Book::query()->create([
                'name' => $request->name,
                'description' => $request->description,
                'is_shown' => boolval($request->is_shown),
                'author_id' => $request->author,
            ]);

            foreach ($request->genres as $genre) {
                $book->genres()->attach($genre);
            }

            $imageName = 'images/' . time() . '.' . $request->file('image')->extension();
            $request->image->move(public_path('images'), $imageName);

            $book->update([
                'image' => $imageName,
            ]);
        }

        return redirect()->back();
    }

    public function deleteBooks(Book $book)
    {
        $book->delete();

        return redirect()->back();
    }

    public function deleteUsers(User $user)
    {
        if (!$user->is_admin) {
            $user->delete();
        }

        return redirect()->back();
    }
}
