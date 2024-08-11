<?php

namespace App\DTOs;

use App\Models\Journal;

class JournalDTO
{
    private $id;
    private $shipment_id;
    private $type;
    private $amount;
    private $created_at;
    private $updated_at;

    public function __construct(Journal $journal = null)
    {
        if ($journal) {
            $this->id = $journal->id;
            $this->shipment_id = $journal->shipment_id;
            $this->type = $journal->type;
            $this->amount = $journal->amount;
            $this->created_at = $journal->created_at;
            $this->updated_at = $journal->updated_at;
        }
    }

    // Getter for all attributes
    public function toArray()
    {
        return [
            'id' => $this->id,
            'shipment_id' => $this->shipment_id,
            'type' => $this->type,
            'amount' => $this->amount,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    // Setter for all attributes
    public function fromArray(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->shipment_id = $data['shipment_id'] ?? null;
        $this->type = $data['type'] ?? null;
        $this->amount = $data['amount'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->updated_at = $data['updated_at'] ?? null;
    }
}
