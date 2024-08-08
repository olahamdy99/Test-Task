<?php
namespace App\DTOs;

class ShipmentDTO
{
    public $id;
    public $code;
    public $shipper;
    public $image;
    public $weight;
    public $description;
    public $price;
    public $status;
    public $updated_by;
//     public $user;

    public function __construct($data)
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
     //    $this->user = $data['user'] ?? null;
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
}
?>
