<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $books = Book::query()->where('is_shown', true)->get();

        return view('home', compact(['books']));
    }
}
