<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ParDetail extends Model
{
    use HasFactory;
    
    protected $table = 'par_details';
    protected $fillable = ['par_header_id', 'item_id', 'sku', 'barcode', 'item_description', 'price', 'quantity', 'transfer_type', 'transfer_specification', 'status',  'date_received',  'transferred_to',  'date_transferred', 'par_attachment', 'ptr_attachment',  'remarks', 'created_by'];
    

    public function par_header()
    {
        return $this->belongsTo(ParHeader::class);
    }

    public function par_borrowed_items()
    {
        return $this->hasMany(ParBorrowedItem::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }

    public function transferred_to_employee()
    {
        return $this->belongsTo(Employee::class, 'transferred_to', 'id')->withTrashed()->withDefault();
    }

}
