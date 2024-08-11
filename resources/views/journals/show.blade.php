@extends('layouts.app')

@section('title', 'Journal Entry Details')

@section('content')
    <h1 class="mb-4">Journal Entry Details</h1>

    <div class="card">
        <div class="card-body">
            @php
                $data = $journal->toArray();
            @endphp
            <h5 class="card-title">Journal #{{ $data['id'] }}</h5>
            <p class="card-text"><strong>Shipment ID:</strong> {{ $data['shipment_id'] }}</p>
            <p class="card-text"><strong>Type:</strong> {{ $data['type'] }}</p>
            <p class="card-text"><strong>Amount:</strong> ${{ number_format($data['amount'], 2) }}</p>
            <a href="{{ route('journals.edit', $data['id']) }}" class="btn btn-primary">Edit</a>
            <a href="{{ route('journals.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
@endsection
