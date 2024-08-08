<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'shipper',
        'image',
        'weight',
        'description',
        'price',
        'status',
        'updated_by'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
