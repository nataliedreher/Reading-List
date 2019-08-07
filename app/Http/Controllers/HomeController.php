<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $readingList = ['Dune', 'Frankenstein', '1984'];

        return view('list', ['readingList' => $readingList]);
    }

}
