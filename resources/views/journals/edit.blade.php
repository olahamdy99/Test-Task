@extends('layouts.app')

@section('title', 'Edit Journal Entry')

@section('content')
    <h1 class="mb-4">Edit Journal Entry</h1>

    @php
        $data = $journal->toArray(); // Convert the DTO to an array
    @endphp

    <form action="{{ route('journals.update', $data['id']) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="shipment_id">Shipment ID</label>
            <input type="number" class="form-control" id="shipment_id" name="shipment_id" value="{{ old('shipment_id', $data['shipment_id']) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                @foreach(App\Services\Enums\JournalTypeService::getTypes() as $type)
                    <option value="{{ $type }}" {{ $data['type'] == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $data['amount']) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Journal Entry</button>
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
