@extends('layouts.app')

@section('title', 'Edit Shipment')

@section('content')
    <h1 class="mb-4">Edit Shipment</h1>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @php
        $data = $shipment->toArray();
    @endphp

    <form action="{{ route('shipments.update', $data['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="code">Code</label>
            <input type="text" class="form-control" id="code" name="code" value="{{ old('code', $data['code']) }}" required>
        </div>

        <div class="form-group">
            <label for="shipper">Shipper</label>
            <input type="text" class="form-control" id="shipper" name="shipper" value="{{ old('shipper', $data['shipper']) }}" required>
        </div>

        <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" name="weight" value="{{ old('weight', $data['weight']) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $data['description']) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select class="form-control" id="status" name="status" required>
                @foreach(App\Services\Enums\ShipmentStatusService::getStatuses() as $status)
                    <option value="{{ $status }}" {{ $data['status'] == $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
            @if($data['image'])
                <img src="{{ asset('storage/' . $data['image']) }}" alt="Shipment Image" class="img-fluid mt-2" style="max-width: 150px;">
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update Shipment</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
