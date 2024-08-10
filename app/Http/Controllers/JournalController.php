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
        $journals = $this->journalService->getAll(); 
        // return response()->json($this->journalService->getAll());
        // return view('journals.index', compact('journals'));
        return view('journals.index', ['journals' => $journals]);

    }

    public function show(int $id)
    {

        $journal = $this->journalService->getById($id);
        // return response()->json($journal);
        return view('journals.show', compact('journal'));
    }
    
    public function create()
    {
        return view('journals.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'shipment_id' => 'required|exists:shipments,id',
            'type' => 'required|string|in:' . implode(',', JournalTypeService::getTypes()),
            'amount' => 'required|numeric',
        ]);

        // return response()->json($this->journalService->create($data), 201);
        return redirect()->route('journals.index')->with('success', 'Journal entry created successfully.');

    }

    public function edit(int $id)
    {
        $journal = $this->journalService->getById($id);
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'shipment_id' => 'nullable|exists:shipments,id',
            'type' => 'nullable|string|in:' . implode(',', JournalTypeService::getTypes()),
            'amount' => 'nullable|numeric',
        ]);

        // return response()->json($this->journalService->update($id, $data));
        return redirect()->route('journals.index')->with('success', 'Journal entry updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->journalService->delete($id);
        // return response()->json(['message' => 'Journal deleted successfully']);
        return redirect()->route('journals.index')->with('success', 'Journal entry deleted successfully.');
    }


}
