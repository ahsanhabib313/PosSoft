<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DraftOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
 
        'order_id',
        'product_id',
        'sell_type_id',
        'manufacture',
        'quantity',
        'productPrice',
        'productUnitPrice',
        'productUnit'
    
];
}
