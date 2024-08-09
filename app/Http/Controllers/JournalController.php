<?php
namespace App\Http\Controllers;

use App\Services\JournalService;
use Illuminate\Http\Request;
use App\Services\Enums\JournalTypeService;

class JournalController extends Controller
{
    protected $journalService;

    public function __construct(JournalService $journalService)
    {
        $this->journalService = $journalService;
    }

    public function index()
    {
        return response()->json($this->journalService->getAll());

    }

    public function show(int $id)
    {

        $journal = $this->journalService->getById($id);
        return response()->json($journal);
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'type' => 'required|string|in:' . implode(',', JournalTypeService::getTypes()),
            'amount' => 'required|numeric',
        ]);

        return response()->json($this->journalService->create($data), 201);
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'shipment_id' => 'nullable|exists:shipments,id',
            'type' => 'nullable|string|in:' . implode(',', JournalTypeService::getTypes()),
            'amount' => 'nullable|numeric',
        ]);

        return response()->json($this->journalService->update($id, $data));
    }

    public function destroy(int $id)
    {
        $this->journalService->delete($id);
        return response()->json(['message' => 'Journal deleted successfully']);
    }


}
