<?php
namespace App\DTOs;

class ShipmentDTO
{
    private $id;
    private $code;
    private $shipper;
    private $image;
    private $weight;
    private $description;
    private $price;
    private $status;
    private $updated_by;

    public function __construct($data)
    {
        $this->fromArray($data);
    }

    private function calculatePrice($weight)
    {
        if ($weight >= 1 && $weight <= 50) {
            return 10;
        } elseif ($weight > 50 && $weight <= 80) {
            return 100;
        } elseif ($weight > 80) {
            return 300;
        }
        return 0;
    }

    // Getter for all attributes
    public function toArray()
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'shipper' => $this->shipper,
            'image' => $this->image,
            'weight' => $this->weight,
            'description' => $this->description,
            'price' => $this->price,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
        ];
    }

    // Setter for all attributes
    public function fromArray(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->code = $data['code'];
        $this->shipper = $data['shipper'];
        $this->image = $data['image'];
        $this->weight = $data['weight'];
        $this->description = $data['description'];
        $this->price = $this->calculatePrice($data['weight']);
        $this->status = $data['status'];
        $this->updated_by = $data['updated_by'] ?? null;
    }
}
?>
