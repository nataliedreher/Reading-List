@extends('layouts.app')

    @section('content')

<div class="container flex-center position-ref full-height">
    <h2>Add shit</h2>
    <div class="input-group mb-3">
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
            <label class="form-check-label" for="inlineRadio1">Author</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
            <label class="form-check-label" for="inlineRadio2">Title</label>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Author or Title" aria-label="Author or Title"
                aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="button-addon2">Search</button>
            </div>
        </div>
    </div>

@endsection
