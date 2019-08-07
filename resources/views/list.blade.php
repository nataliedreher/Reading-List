@extends('layouts.app')

@section('content')

<div class="container flex-center position-ref full-height">
    <h2>Reading List</h2>
    <ul>
        @foreach ($readingList as $item)
            <li>{{ $item }}</li>
        @endforeach
    </ul>
</div>

@endsection
