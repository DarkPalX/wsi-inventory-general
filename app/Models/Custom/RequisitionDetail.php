<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequisitionDetail extends Model
{
    use HasFactory;
    
    protected $table = 'requisition_details';
    protected $fillable = ['requisition_header_id', 'ref_no', 'item_id', 'sku', 'quantity'];
    

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
