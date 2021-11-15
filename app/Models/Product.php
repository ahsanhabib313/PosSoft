<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable =
    [
        'manufacture',
        'productName',
        'photo',
        'category_id',
        'companyName',
        'productWeight',
        'productWeightUnit',
        'buyingPrice',
        'retailPrice',
        'wholesalePrice',
        'quantity',
        'productQuantityUnit',
        'alertQuantity',
        'barCode',
        'expireDate'



       
    ];

    public function category(){

        return $this->belongsTo(Category::class);
    }
   
}
