@extends('layouts.app')

@section('content')

<div class="container flex-center position-ref full-height">
    <h2>Reading List</h2>
    <ul class="list-group list-group-horizontal-sm">
        <li class="list-group-item">Sort by:</li>
        <li class="list-group-item"><a href="/books/show/byauthor">Author</a></li>
        <li class="list-group-item"><a href="/books/show/bytitle">Title</a></li>
        <li class="list-group-item"><a href="/books/show/bydate">Date Added</a></li>
        <li class="list-group-item"><a href="/books">Reading Order</a></li>
    </ul>
    <br>
    <ol>
        <div class="accordion" id="book-accordian">
            @foreach ($readingList as $book)
            <li>
                <div class="card">
                    <div class="card-header" id="heading{{ $book->id }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                data-target="#collapse{{ $book->id }}" aria-expanded="false"
                                aria-controls="collapse{{ $book->id }}">
                                Title: {{ $book->title }} | Author: {{ $book->author }}
                            </button>
                            <ul class="list-inline float-right">
                                @if($unsorted)
                                <li class="list-inline-item">
                                    <form method="POST" action="/books/update/{{ $book->id }}">
                                        @csrf
                                        @method("PATCH")
                                        <input type="hidden" name="direction" value="up" />
                                        <button type="submit" class="btn btn-link">Up</button>
                                    </form>
                                </li>
                                <li class="list-inline-item">
                                    <form method="POST" action="/books/update/{{ $book->id }}">
                                        @csrf
                                        @method("PATCH")
                                        <input type="hidden" name="direction" value="down" />
                                        <button type="submit" class="btn btn-link">Down</button>
                                    </form>
                                </li>
                                @endif
                                <li class="list-inline-item">
                                    <form action="/books/delete/{{ $book->id }}" method="POST">
                                        @method("DELETE")
                                        <button type="submit" class="btn btn-link">Remove</button>
                                    </form>
                                </li>
                            </ul>
                        </h2>
                    </div>
                    <div id="collapse{{ $book->id }}" class="collapse" aria-labelledby="heading{{ $book->id }}"
                        data-parent="#book-accordian">
                        <div class="card-body">
                            {{ $book->description }}
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </div>
    </ol>
</div>

@endsection
