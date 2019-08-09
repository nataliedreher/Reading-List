@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Hi {{ Auth::user()->name }}!</h2>
    <p>Welcome to your reading list.</p>
</div>

@endsection
