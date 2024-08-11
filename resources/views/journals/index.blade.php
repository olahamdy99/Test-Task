@extends('layouts.app')

@section('title', 'Journals')

@section('content')
    <h1 class="mb-4">Journals</h1>

    <a href="{{ route('journals.create') }}" class="btn btn-primary mb-3">Create Journal Entry</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Shipment ID</th>
                <th scope="col">Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($journals as $journalDTO)
                @php
                    $data = $journalDTO->toArray();
                @endphp
                <tr>
                    <th scope="row">{{ $data['id'] }}</th>
                    <td>{{ $data['shipment_id'] }}</td>
                    <td>{{ $data['type'] }}</td>
                    <td>${{ $data['amount'] }}</td>
                    <td>{{ $data['created_at'] }}</td>
                    <td>{{ $data['updated_at'] }}</td>
                    <td>
                        <a href="{{ route('journals.show', $data['id']) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('journals.edit', $data['id']) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('journals.destroy', $data['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
