@extends('layouts.app')

@section('title', 'Shipment Details')

@section('content')
    <h1 class="mb-4">Shipment Details</h1>

    <div class="card">
        <div class="card-body">
            @php
                $data = $shipment->toArray();
            @endphp
            <p><strong>ID:</strong> {{ $data['id'] }}</p>
            <p><strong>Code:</strong> {{ $data['code'] }}</p>
            <p><strong>Shipper:</strong> {{ $data['shipper'] }}</p>
            <p><strong>Weight:</strong> {{ $data['weight'] }}</p>
            <p><strong>Description:</strong> {{ $data['description'] }}</p>
            <p><strong>Status:</strong> {{ $data['status'] }}</p>
            <p><strong>Updated By:</strong> {{ $data['updated_by'] }}</p>

            @if($data['image'])
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $data['image']) }}" alt="Shipment Image" class="img-thumbnail mt-2" style="width: 200px;">
            @endif

            <a href="{{ route('shipments.index') }}" class="btn btn-secondary mt-3">Back to Shipments</a>
        </div>
    </div>
@endsection
