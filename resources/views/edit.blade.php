<!-- resources/views/technology/edit.blade.php -->

@extends('layout')

@section('content')
    <h1>Edit Technology Tag</h1>
    <form action="{{ route('technology-tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Tag Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $tag->name }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Tag</button>
    </form>
@endsection
