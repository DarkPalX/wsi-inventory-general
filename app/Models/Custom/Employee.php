<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'employees';
    protected $fillable = ['name', 'user_id', 'section_id', 'department', 'position', 'emp_id', 'hired_date', 'avatar'];


    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function par_headers()
    {
        return $this->hasMany(ParHeader::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class)->withTrashed()->withDefault();
    }

    public function par_borrowed_items()
    {
        return $this->hasMany(ParBorrowedItem::class);
    }

    public static function getEmployeeId($data){

        if (empty($data) || !str_contains($data, ' : ')) {
            return null;
        }
        else{
            $employee = Employee::where('emp_id', explode(" : ", $data)[0])->where('name', explode(" : ", $data)[1])->first();
            return $employee->id ?? null;
        }
    }
}
