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
            @foreach($journals as $journal)
                <tr>
                    <th scope="row">{{ $journal->id }}</th>
                    <td>{{ $journal->shipment_id }}</td>
                    <td>{{ $journal->type }}</td>
                    <td>${{ $journal->amount }}</td>
                    <td>{{ $journal->created_at }}</td>
                    <td>{{ $journal->updated_at }}</td>
                    <td>
                        <a href="{{ route('journals.show', $journal->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('journals.destroy', $journal->id) }}" method="POST" style="display:inline;">
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
