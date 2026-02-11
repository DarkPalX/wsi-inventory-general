<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    use HasFactory;
    
    protected $table = 'purchase_order_details';
    protected $fillable = ['purchase_order_header_id', 'po_number', 'item_id', 'sku', 'quantity', 'remaining', 'price'];


    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
