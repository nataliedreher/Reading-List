<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Auth;

class BooksController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $readingList = Book::all()
            ->where('email',  Auth::user()->email)
            ->sortBy('reading_order');
        $unsorted = true;
        return view('books.index', ['readingList' => $readingList, 'unsorted' => $unsorted]);
    }

    /**
     * Search page for finding a new book (rather than a form for creating them).
     * This is the only non-standard route.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('books.search');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $readOrderNum = Book::all()
            ->where('email',  Auth::user()->email)
            ->count();

        $book = new Book;
        $book->email = Auth::user()->email;
        $book->author = request('author');
        $book->title = request('title');
        $book->subtitle = request('subtitle');
        $book->description = request('description');
        $book->read_order = $readOrderNum;
        $book->save();

        return redirect('/books');
    }

    /**
     * This route is purposefully being used in an unconvetional manner. It's to "show" the books in different orders.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($sortMethod)
    {
        $unsorted = false;
        if ($sortMethod === 'byauthor') {

            // Query to sort by author
            $readingList = Book::all()
                ->where('email',  Auth::user()->email)
                ->sortBy('author');
            return view('books.index', ['readingList' => $readingList, 'unsorted' => $unsorted]);
        } elseif ($sortMethod === 'bytitle') {

            // Query to sort by title
            $readingList = Book::all()
                ->where('email',  Auth::user()->email)
                ->sortBy('title');
            return view('books.index', ['readingList' => $readingList, 'unsorted' => $unsorted]);
        } elseif ($sortMethod === 'bydate') {

            // Query to sort by date
            $readingList = Book::all()
                ->where('email',  Auth::user()->email)
                ->sortBy('created_at');
            return view('books.index', ['readingList' => $readingList, 'unsorted' => $unsorted]);
        } else {
            return redirect('/books');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //  Edit route not included as it is unneeded
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        // First set variables needed for both sorting directions
        $book1 = Book::find($id);
        $queryIdArray = Book::all()
            ->pluck('id');
        $queryIndex = array_search($book1->id, $queryIdArray->all());

        // Check for direction and if said direction change is valid
        if (request('direction') === 'up' && $queryIndex > 0) {

            // If moving book up first grab data from line above it then update both lines with new data
            $idTwo = $queryIdArray[$queryIndex - 1];
            $book2 = Book::find($idTwo);
            Book::find($idTwo)
                ->update(['author' => $book1->author, 'title' => $book1->title, 'subtitle' => $book1->subtitle, 'description' => $book1->description, 'created_at' => $book1->created_at,]);
            Book::find($id)
                ->update(['author' => $book2->author, 'title' => $book2->title, 'subtitle' => $book2->subtitle, 'description' => $book2->description, 'created_at' => $book2->created_at,]);
            return redirect('/books');
        } elseif (request('direction') === 'down' && $queryIndex < count($queryIdArray) - 1) {

            // If moving book down first grab data from line below it then update both lines with new data
            $idTwo = $queryIdArray[$queryIndex + 1];
            $book2 = Book::find($idTwo);
            Book::find($idTwo)
                ->update(['author' => $book1->author, 'title' => $book1->title, 'subtitle' => $book1->subtitle, 'description' => $book1->description, 'created_at' => $book1->created_at,]);
            Book::find($id)
                ->update(['author' => $book2->author, 'title' => $book2->title, 'subtitle' => $book2->subtitle, 'description' => $book2->description, 'created_at' => $book2->created_at,]);
            return redirect('/books');
        } else {
            return redirect('/books');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::find($id)->delete();
        return redirect('/books');
    }
}
