<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $table = 'divisions';
    protected $fillable = ['name', 'head_emp_id'];


    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'head_emp_id', 'id')->withTrashed()->withDefault();
    }
}
