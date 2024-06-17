@extends('layout')

@section('content')

    <div class="container">
        <h1>Technology Tag Report</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Technology Tag</th>
                    <th>Number of Customers</th>
                </tr>
            </thead>
            <tbody>
                @foreach($technologyTags as $technologyTags)
                    <tr>
                        <td>{{ $technologyTags->name }}</td>
                        <td>{{ $technologyTags->customers_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
@endsection
