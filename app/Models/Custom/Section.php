<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'sections';
    protected $fillable = ['name', 'division_id', 'head_emp_id', 'secretary_emp_id'];

    public function division()
    {
        return $this->belongsTo(Division::class)->withTrashed()->withDefault();
    }

    public function head()
    {
        return $this->belongsTo(Employee::class, 'head_emp_id', 'id')->withTrashed()->withDefault();
    }

    public function secretary()
    {
        return $this->belongsTo(Employee::class, 'secretary_emp_id', 'id')->withTrashed()->withDefault();
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function users()
    {
        return $this->hasMany(Employee::class);
    }

    public function receiving_headers()
    {
        return $this->hasMany(ReceivingHeader::class);
    }

    public function issuance_headers()
    {
        return $this->hasMany(IssuanceHeader::class);
    }
}
