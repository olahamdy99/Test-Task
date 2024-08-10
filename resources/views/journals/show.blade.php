@extends('layouts.app')

@section('title', 'Journal Entry Details')

@section('content')
    <h1 class="mb-4">Journal Entry Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Journal #{{ $journal->id }}</h5>
            <p class="card-text"><strong>Shipment ID:</strong> {{ $journal->shipment_id }}</p>
            <p class="card-text"><strong>Type:</strong> {{ $journal->type }}</p>
            <p class="card-text"><strong>Amount:</strong> ${{ number_format($journal->amount, 2) }}</p>
            <a href="{{ route('journals.edit', $journal->id) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('journals.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
