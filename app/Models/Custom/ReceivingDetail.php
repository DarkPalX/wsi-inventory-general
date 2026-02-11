<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceivingDetail extends Model
{
    use HasFactory;
    
    protected $table = 'receiving_details';
    protected $fillable = ['receiving_header_id', 'item_id', 'sku', 'cost', 'order', 'quantity'];


    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed()->withDefault();
    }

    public function header()
    {
        return $this->belongsTo(ReceivingHeader::class,'receiving_header_id')->withTrashed();
    }

}
