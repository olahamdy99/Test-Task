@extends('layouts.app')

@section('title', 'Shipments List')

@section('content')
    <h1 class="mb-4">Shipments</h1>

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

    <a href="{{route ('shipments.create') }}" class="btn btn-primary mb-3">Create New Shipment</a>

    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Shipper</th>
                <th>Weight</th>
                <th>Price</th>
                <th>Description</th>
                <th>Status</th>
                <th>Updated By</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
                @foreach($shipments as $shipmentDTO)
            @php
                $shipment = $shipmentDTO->toArray();
            @endphp
            <tr>
                <td>{{ $shipment['id'] }}</td>
                <td>{{ $shipment['code'] }}</td>
                <td>{{ $shipment['shipper'] }}</td>
                <td>{{ $shipment['weight'] }}</td>
                <td>{{ $shipment['price'] }}</td>
                <td>{{ $shipment['description'] }}</td>
                <td>{{ $shipment['status'] }}</td>
                <td>{{ $shipment['updated_by'] ?: 'N/A' }}</td>
                <td>
                    @if($shipment['image'])
                        <img src="{{ asset('storage/' . $shipment['image']) }}" alt="Shipment Image" class="img-fluid" style="max-width: 50px; height: auto;">
                    @else
                        No Image
                    @endif
                </td>
                <td>
                    <a href="{{ route('shipments.show', $shipment['id']) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('shipments.edit', $shipment['id']) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('shipments.destroy', $shipment['id']) }}" method="POST" style="display:inline;">
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
