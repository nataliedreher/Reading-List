<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $readingList = ['Dune', 'Frankenstein', '1984'];

        return view('list');
    }

    public function add()
    {
        return view('add');
    }

    public function list()
    {
        $readingList = Book::all()
            ->where('email',  Auth::user()->email);

        return view('list', ['readingList' => $readingList]);
    }

    public function store()
    {
        $book = new Book;
        $book->email = Auth::user()->email;
        $book->author = request('author');
        $book->title = request('title');
        $book->subtitle = request('subtitle');
        $book->description = request('description');
        $book->save();

        return redirect('/reading-list');
    }
}
