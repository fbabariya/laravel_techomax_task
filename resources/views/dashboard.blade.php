@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .sidebar {
            background-color: darkslategray; 
            height: 100vh; 
            padding: 20px; 
        }
        .sidebar .btn {
            width: 100%;
            margin-bottom: 10px; 
        }
    </style>
</head>

<body>
    

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="card sidebar">
                    <div class="card-body">
                        <h5 class="card-title" style="color: aliceblue">Sidebar</h5>
                        @if(auth()->check())
                            @if(auth()->user()->roll_id == 1)
                                <!-- Admin sidebar links -->
                                <a href="{{ route('referrer.report') }}" class="btn btn-primary">Referrer Report</a>
                                <a href="{{ route('technology-tag.report') }}" class="btn btn-primary">Technology Tag Report</a>
                                <a href="{{ route('technology-tags.index') }}" class="btn btn-primary">Add/Remove Technology</a>
                            @else
                                <form action="{{ route('select.technology') }}" method="POST">
                                    @csrf
                                    <h5>Select Technology Tags:</h5>
                                    @foreach($technologyTags as $tag)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="technology_tags[]" value="{{ $tag->id }}" id="tag_{{ $tag->id }}" {{ optional($user->technologytags)->contains($tag) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="tag_{{ $tag->id }}">
                                                {{ $tag->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary mt-3">Save Selection</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
            <!-- Main Content Area -->
            <div class="col-md-9">
                @if(auth()->check())
                <h1>Hello, {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h1>
                    @if(auth()->user()->roll_id == 0)
                        
                        <h2>Selected Technology Tags:</h2>
                            @if($selectedTags->isEmpty())
                                <p>No technology tags selected.</p>
                            @else
                                <ul>
                                    @foreach($selectedTags as $tag)
                                        <li>{{ $tag->name }}</li>
                                    @endforeach
                                </ul>
                            @endif
                    @endif

                   
                    
                @endif
                <!-- Add Content Here -->
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection 