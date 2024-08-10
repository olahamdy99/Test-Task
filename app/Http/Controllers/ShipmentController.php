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
        // return response()->json($shipments);
        return view('shipments.index', ['shipments' => $shipments]);

    }

    public function create()
    {
        return view('shipments.create');
    }
    
    public function edit($id)
    {
        $shipment = $this->shipmentService->getShipmentById($id);
        return view('shipments.edit', compact('shipment'));
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
        // return response()->json($shipment);


        return view('shipments.create', ['shipment' => $shipment]);

    }

    public function show(int $id)
    {
        $shipment = $this->shipmentService->getShipmentById($id);
        // return response()->json($shipment);

        return view('shipments.show', ['shipment' => $shipment]);

    }

    public function update(Request $request, int $id)
    {
        // Log::info('Request data', $request->all()); // Log the request data
    
        $data = $request->validate([
            'code' => 'nullable|string|unique:shipments,code,' . $id,
            'shipper' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'weight' => 'nullable|numeric',
            'description' => 'nullable|string',
            'status' => 'nullable|in:Pending,Progress,Done',
            'updated_by' => 'nullable|string',
        ]);
    
        if ($request->hasFile('image')) {
            $filePath = $request->file('image')->store('images', 'public');
            $data['image'] = $filePath;
        }
    
 
        // Log::info('Validated data', $data); // Log the validated data
    
        $shipment = $this->shipmentService->updateShipment($id, $data);
        // return response()->json($shipment);

        return view('shipments.edit', ['shipment' => $shipment]);


    }

    public function destroy(int $id)
    {
        $this->shipmentService->deleteShipment($id);
        // return response()->json(['message' => 'Shipment deleted successfully']);

        return redirect()->route('shipments.index')->with('success', 'Shipment deleted successfully');

    }

}

