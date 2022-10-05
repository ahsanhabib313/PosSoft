<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = ['merchant_id','bank_id','transaction_type_id','amount','photo','date'];

    public function merchant()
    {
        return $this->belongsTo(Merchant::class);
    }
    public function Bank()
    {
        return $this->belongsTo(Bank::class);
    }
    public function TransactionType()
    {
        return $this->belongsTo(TransactionType::class);
    }
  


}
