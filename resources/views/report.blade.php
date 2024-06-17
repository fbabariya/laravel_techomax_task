<!-- resources/views/referrer/report.blade.php -->

@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h1>Referrer Report</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Source</th>
                        <th>count registration</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($referrerCounts as $referrer)
                    <tr>
                        <td>{{ $referrer->Date }}</td>
                        <td>{{ $referrer->Source }}</td>
                        <td>{{ $referrer->registration }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
</div>
@endsection
