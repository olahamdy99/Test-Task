@extends('layouts.app')

@section('title', 'Create Journal Entry')

@section('content')
    <h1 class="mb-4">Create Journal Entry</h1>

    <form action="{{ route('journals.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="shipment_id">Shipment ID</label>
            <input type="number" class="form-control" id="shipment_id" name="shipment_id" value="{{ old('shipment_id') }}" required>
        </div>

        <div class="form-group">
            <label for="type">Type</label>
            <select class="form-control" id="type" name="type" required>
                @foreach(App\Services\Enums\JournalTypeService::getTypes() as $type)
                    <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="amount">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" value="{{ old('amount') }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Save Journal Entry</button>
        <a href="{{ route('journals.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
