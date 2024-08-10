@extends('layouts.app')

@section('title', 'Shipment Details')

@section('content')
    <h1 class="mb-4">Shipment Details</h1>

    <div class="card">
        <div class="card-body">
            <p><strong>ID:</strong> {{ $shipment->id }}</p>
            <p><strong>Code:</strong> {{ $shipment->code }}</p>
            <p><strong>Shipper:</strong> {{ $shipment->shipper }}</p>
            <p><strong>Weight:</strong> {{ $shipment->weight }}</p>
            <p><strong>Description:</strong> {{ $shipment->description }}</p>
            <p><strong>Status:</strong> {{ $shipment->status }}</p>
            <p><strong>Updated By:</strong> {{ $shipment->updated_by }}</p>

            @if($shipment->image)
                <p><strong>Image:</strong></p>
                <img src="{{ asset('storage/' . $shipment->image) }}" alt="Shipment Image" class="img-thumbnail mt-2" style="width: 200px;">
            @endif

            <a href="{{ route('shipments.index') }}" class="btn btn-secondary mt-3">Back to Shipments</a>
        </div>
    </div>
@endsection
