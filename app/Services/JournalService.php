<?php

namespace App\Services;

use App\Models\Journal;
use App\DTOs\JournalDTO;


class JournalService
{
    public function getAll()
    {
        return Journal::all()->map(fn($journal) => new JournalDTO($journal));
    }

    public function getById($id)
    {
        $journal = Journal::findOrFail($id);
        return new JournalDTO($journal);
    }

    public function create($data)
    {
        try {
            $journal = Journal::create($data);
            return new JournalDTO($journal);
        } catch (\Exception $e) {
            // \Log::error('Error creating journal:', ['error' => $e->getMessage()]);
            throw $e;
        }
    }
    
    public function update($id, $data)
    {
        $journal = Journal::findOrFail($id);
        $journal->update($data);
        return new JournalDTO($journal);
    }

    public function delete( $id)
    {
        $journal = Journal::findOrFail($id);
        $journal->delete();
        return response()->noContent();
    }
}
