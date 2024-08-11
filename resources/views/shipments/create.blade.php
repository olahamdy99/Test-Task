@extends('layouts.app')

@section('title', 'Create Shipment')

@section('content')
    <h1 class="mb-4">Create Shipment</h1>
    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('shipments.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" required>
        </div>

        <div class="form-group">
            <label for="shipper">Shipper</label>
            <input type="text" class="form-control" id="shipper" name="shipper" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                @foreach(App\Services\Enums\ShipmentStatusService::getStatuses() as $status)
                    <option value="{{ $status }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
        </div>
     

        <button type="submit" class="btn btn-primary">Create Shipment</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
