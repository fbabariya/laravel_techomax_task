<!-- resources/views/technology/create.blade.php -->

@extends('layout')

@section('content')
    <h1>Add New Technology Tag</h1>
    <form action="{{ route('technology-tags.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Tag Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Tag</button>
    </form>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
@endsection
