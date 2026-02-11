<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParBorrowedItem extends Model
{
    use HasFactory;
    
    protected $table = 'par_borrowed_items';
    protected $fillable = ['par_detail_id', 'item_id', 'sku', 'barcode', 'item_description', 'employee_id', 'date_borrowed', 'date_returned', 'status', 'remarks', 'created_by'];


    public function par_detail()
    {
        return $this->belongsTo(ParDetail::class);
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed()->withDefault();
    }

}
