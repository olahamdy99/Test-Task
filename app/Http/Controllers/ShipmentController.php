<?php
namespace App\Http\Controllers;

use App\Services\ShipmentService;
use App\DTOs\ShipmentDTO;
use Illuminate\Http\Request;
use App\Services\Enums\ShipmentStatusService;
use Illuminate\Support\Facades\Log;

class ShipmentController extends Controller
{
    protected $shipmentService;

    public function __construct(ShipmentService $shipmentService)
    {

        $this->shipmentService = $shipmentService;
    }

    public function index()
    {
        $shipments = $this->shipmentService->getAllShipments();
        return response()->json($shipments);

      
        return view('shipments.index', compact('shipments'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'code' => 'required|string|unique:shipments,code',
            'shipper' => 'required|string',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'weight' => 'required|numeric',
            'description' => 'required|string',
            'status' => 'required|in:' . implode(',', ShipmentStatusService::getStatuses()),
            'updated_by' => 'nullable|string',
        ]);

    
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $data['image'] = $filePath;
        }

 

        $shipmentDTO = new ShipmentDTO($data);
        $shipment = $this->shipmentService->createShipment($shipmentDTO);
        return response()->json($shipment);


    }

    public function show(int $id)
    {
        $shipment = $this->shipmentService->getShipmentById($id);
        return response()->json($shipment);

    }

    public function update(Request $request, int $id)
    {
        // Log::info('Request data', $request->all()); // Log the request data
    
        $data = $request->validate([
            'code' => 'sometimes|string|unique:shipments,code,' . $id,
            'shipper' => 'sometimes|string',
            'image' => 'sometimes|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'weight' => 'sometimes|numeric',
            'description' => 'sometimes|string',
            'status' => 'sometimes|in:Pending,Progress,Done',
            'updated_by' => 'nullable|string',
        ]);
    
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $data['image'] = $filePath;
        }
    
 
        // Log::info('Validated data', $data); // Log the validated data
    
        $shipment = $this->shipmentService->updateShipment($id, $data);
        return response()->json($shipment);
    }

    public function destroy(int $id)
    {
        $this->shipmentService->deleteShipment($id);
        return response()->json(['message' => 'Shipment deleted successfully']);


    }

}

