@extends('layouts.app')

@section('title', 'Edit Journal Entry')

@section('content')
    <h1 class="mb-4">Edit Journal Entry</h1>

    <form action="{{ route('journals.update', $journal->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="shipment_id">Shipment ID</label>
            <input type="number" class="form-control" id="shipment_id" name="shipment_id" value="{{ old('shipment_id', $journal->shipment_id) }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                @foreach(App\Services\Enums\JournalTypeService::getTypes() as $type)
                    <option value="{{ $type }}" {{ $journal->type == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount', $journal->amount) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Journal Entry</button>
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
