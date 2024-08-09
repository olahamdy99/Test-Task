<?php

namespace App\DTOs;

use App\Models\Journal;

class JournalDTO
{
    public $id;
    public $shipment_id;
    public $type;
    public $amount;
    public $created_at;
    public $updated_at;

    public function __construct(Journal $journal)
    {
        $this->id = $journal->id;
        $this->shipment_id = $journal->shipment_id;
        $this->type = $journal->type;
        $this->amount = $journal->amount;
        $this->created_at = $journal->created_at;
        $this->updated_at = $journal->updated_at;
    }
}
