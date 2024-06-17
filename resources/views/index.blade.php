<!-- resources/views/technology/index.blade.php -->

@extends('layout')

@section('content')
    <h1>Technology Tags</h1>
    <a href="{{ route('technology-tags.create') }}" class="btn btn-success mb-3">Add New Tag</a>

    @if ($tags->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $tag->name }}</td>
                            <td>
                                <a href="{{ route('technology-tags.edit', $tag->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('technology-tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No technology tags found.</p>
    @endif


    <hr/>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3">Back to Dashboard</a>
@endsection
