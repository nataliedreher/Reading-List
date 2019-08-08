@extends('layouts.app')

@section('content')

<div class="container flex-center position-ref full-height">
    <h2>Reading List</h2>
    <ol>
        <div class="accordion" id="book-accordian">
            @foreach ($readingList as $book)
            <li>
                <div class="card">
                    <div class="card-header" id="heading{{ $book->id }}">
                        <h2 class="mb-0">
                            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse{{ $book->id }}"
                                aria-expanded="false" aria-controls="collapse{{ $book->id }}">
                                Title: {{ $book->title }} | Author: {{ $book->author }}
                            </button>
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
