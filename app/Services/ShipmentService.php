<?php

namespace App\Services;

use App\Models\Shipment;
use App\Models\Journal;
use App\DTOs\ShipmentDTO;
use Illuminate\Support\Facades\Log;

class ShipmentService
{
    public function getAllShipments()
    {
        return Shipment::all()->map(fn($shipment) => new ShipmentDTO($shipment->toArray()));
    }

    public function createShipment(ShipmentDTO $shipmentDTO)
    {

        $shipmentData = (array)$shipmentDTO;
        unset($shipmentData['id']);
        $shipment = Shipment::create($shipmentData);
        return new ShipmentDTO($shipment->toArray());
    }

    public function getShipmentById( $id)
    {
        $shipment = Shipment::with('user')->findOrFail($id);
        return new ShipmentDTO($shipment->toArray());
    }

    public function updateShipment( $id, $data)
    {
        $shipment = Shipment::findOrFail($id);
        $existingData = $shipment->toArray();
    
        // Merge existing data with new data
        $mergedData = array_merge($existingData, array_filter($data, function ($value) {
            return !is_null($value);
        }));
    
        Log::info('Merged data before validation', $mergedData); // Log merged data
    
        // Validate the merged data
        $validatedData = validator($mergedData, [
            'code' => 'required|string|unique:shipments,code,' . $id,
            'shipper' => 'required|string',
            'image' => 'nullable|string',
            'weight' => 'required|numeric',
            'description' => 'required|string',
            'status' => 'required|in:Pending,Progress,Done',
            'updated_by' => 'nullable|string',
        ])->validate();
    
        Log::info('Validated merged data', $validatedData); // Log validated merged data
    
        // Update the shipment with validated data
        $shipment->update($validatedData);
    
        // Return the updated shipment as a DTO
        return new ShipmentDTO($shipment->load('user')->toArray());
    }
    

    public function deleteShipment($id)
    {
        $shipment = Shipment::findOrFail($id);
        Journal::where('shipment_id', $id)->delete();
        $shipment->delete();
    }
}
