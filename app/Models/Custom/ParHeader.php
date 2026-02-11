<?php

namespace App\Models\Custom;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ActivityLog;
use App\Models\Scopes\SectionScope;
use Carbon\Carbon;

class ParHeader extends Model
{
    use HasFactory;
    
    protected $table = 'par_headers';
    protected $fillable = ['employee_id', 'section_id', 'date_released_par', 'date_received', 'issuance_header_id', 'attachments', 'remarks', 'created_by', 'updated_by', 'posted_at', 'posted_by', 'cancelled_at', 'cancelled_by'];


    public function par_detail()
    {
        return $this->hasMany(ParDetail::class);
    }

    public function issuance()
    {
        return $this->belongsTo(IssuanceHeader::class, 'issuance_header_id'); // Ensure correct foreign key
    }
    
    public function employee()
    {
        return $this->belongsTo(Employee::class)->withTrashed()->withDefault();
    }

    public static function getEmployeeIdName($par_header_id, $employee_id, $item_id)
    {
        $employee = ParHeader::join('par_details', 'par_headers.id', '=', 'par_details.par_header_id')
        ->join('employees', 'par_headers.employee_id', '=', 'employees.id')
        ->where('par_headers.id', $par_header_id)
        ->where('par_headers.employee_id', $employee_id)
        ->where('par_details.item_id', $item_id)
        ->first(['employees.emp_id', 'employees.name']);

        return $employee->emp_id ." : ". $employee->name;
    }

    // public static function getEmployeeIdName($issuance_header_id, $item_id)
    // {
    //     $employee = ParHeader::where('par_headers.issuance_header_id', $issuance_header_id)->where('par_details.item_id', $item_id)
    //     ->join('issuance_headers', 'par_headers.issuance_header_id', '=', 'issuance_headers.id')
    //     ->join('par_details', 'par_headers.id', '=', 'par_details.par_header_id')
    //     ->join('employees', 'par_headers.employee_id', '=', 'employees.id')
    //     ->first(['emp_id', 'name']);
    
    //     return $employee->emp_id ." : ". $employee->name;
    // }

    public static function getParDetail($issuance_header_id, $item_id)
    {
        $par = ParHeader::where('par_headers.issuance_header_id', $issuance_header_id)->where('par_details.item_id', $item_id)
        ->join('issuance_headers', 'par_headers.issuance_header_id', '=', 'issuance_headers.id')
        ->join('par_details', 'par_headers.id', '=', 'par_details.par_header_id')
        ->join('employees', 'par_headers.employee_id', '=', 'employees.id')
        ->first(['par_headers.id as phid', 'par_details.id as pdid']);

        return $par;
    }


    // ******** AUDIT LOG ******** //
    // Need to change every model
    static $oldModel;
    static $tableTitle = 'purchase-order';
    static $name = '0000' . 'id';
    static $unrelatedFields = ['created_at', 'updated_at', 'deleted_at'];
    static $logName = [
        'id' => 'id',
        'employee_id' => 'employee_id',
        'section_id' => 'section_id',
        'date_released_par' => 'date_released_par',
        'date_received' => 'date_received',
        'issuance_header_id' => 'issuance_header_id',
        'attachments' => 'attachments', 
        'remarks' => 'remarks', 
        'created_by' => 'created_by', 
        'updated_by' => 'updated_by', 
        'posted_at' => 'posted_at', 
        'posted_by' => 'posted_by', 
        'cancelled_at' => 'cancelled_at', 
        'cancelled_by' => 'cancelled_by'
    ];
    // END Need to change every model

    public static function boot()
    {
        parent::boot();
        
        static::addGlobalScope(new SectionScope);

        self::created(function($model) {
            $name = $model[self::$name];

            ActivityLog::create([
                'log_by' => auth()->id(),
                'activity_type' => 'insert',
                'dashboard_activity' => 'created a new '. self::$tableTitle,
                'activity_desc' => 'created the '. self::$tableTitle .' '. $name,
                'activity_date' => date("Y-m-d H:i:s"),
                'db_table' => $model->getTable(),
                'old_value' => '',
                'new_value' => $name,
                'reference' => $model->id
            ]);
        });

        self::updating(function($model) {
            self::$oldModel = $model->fresh();
        });

        self::updated(function($model) {
            $name = $model[self::$name];
            $oldModel = self::$oldModel->toArray();
            foreach ($oldModel as $fieldName => $value) {
                if (in_array($fieldName, self::$unrelatedFields)) {
                    continue;
                }

                $oldValue = $model[$fieldName];
                if ($oldValue != $value) {
                    ActivityLog::create([
                        'log_by' => auth()->id(),
                        'activity_type' => 'update',
                        'dashboard_activity' => 'updated the '. self::$tableTitle .' '. self::$logName[$fieldName],
                        'activity_desc' => 'updated the '. self::$tableTitle .' '. self::$logName[$fieldName] .' of '. $name .' from '. $oldValue .' to '. $value,
                        'activity_date' => date("Y-m-d H:i:s"),
                        'db_table' => $model->getTable(),
                        'old_value' => $oldValue,
                        'new_value' => $value,
                        'reference' => $model->id
                    ]);
                }
            }
        });

        self::deleted(function($model){
            $name = $model[self::$name];
            ActivityLog::create([
                'log_by' => auth()->id(),
                'activity_type' => 'delete',
                'dashboard_activity' => 'deleted a '. self::$tableTitle,
                'activity_desc' => 'deleted the '. self::$tableTitle .' '. $name,
                'activity_date' => date("Y-m-d H:i:s"),
                'db_table' => $model->getTable(),
                'old_value' => '',
                'new_value' => '',
                'reference' => $model->id
            ]);
        });
    }
}
