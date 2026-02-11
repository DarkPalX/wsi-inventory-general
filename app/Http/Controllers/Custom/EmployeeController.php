<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;

use Facades\App\Helpers\{ListingHelper, FileHelper};
use App\Helpers\ModelHelper;

use App\Models\{Page};
use App\Models\Custom\{Section, Employee, ParHeader, ParDetail};
use DB;

class EmployeeController extends Controller
{
    private $searchFields = ['name'];

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,  [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }

    public function index()
    {
        $page = new Page();
        $page->name = "Employees";

        $employees = ListingHelper::simple_search(Employee::class, $this->searchFields);

        $sections = Section::all();
    
        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

       return view('theme.pages.custom.issuance.employees.index', compact('page', 'employees', 'sections', 'filter', 'searchType'));
    }

    public function create()
    {
        $page = new Page();
        $page->name = "Employees";

       return view('theme.pages.custom.issuance.employees.create', compact('page'));
    }

    public function store(Request $request)
    {
        $emp_id_exists = Employee::where('emp_id', $request->emp_id)->first();

        if($emp_id_exists == null){
            $employee = Employee::create([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'department' => $request->department,
                'position' => $request->position,
                'emp_id' => $request->emp_id,
                'hired_date' => $request->hired_date,
            ]);

            // FOR FILE UPLOADS
            $avatar = $request->hasFile('avatar') ? FileHelper::move_to_files_folder($request->file('avatar'), 'attachments/employees/'. $request->emp_id)['url'] : null;
            $employee->update([
                'avatar' => $avatar
            ]);

            Artisan::call('db:seed', [
                '--class' => 'Database\\Seeders\\EmployeeUserSeeder',
            ]);

            return redirect()->route('issuance.employees.index')->with('alert', 'success:Well done! You successfully added a employee');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Employee already exists');
        }
    }

    public function show($id)
    {
        $page = new Page();
        $page->name = "PAR Details";
    
        $employee = Employee::find($id);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';


        if(isset($_GET['is_search']) && $_GET['is_search']==1){


            $qry = "SELECT DISTINCT h.*, d.* FROM par_details d 
                    LEFT JOIN par_headers h ON h.id = d.par_header_id 
                    LEFT JOIN items i ON i.id = d.item_id
                    WHERE d.id > 0 AND h.employee_id = " . $id;

            if(isset($_GET['search']) && strlen($_GET['search']) > 0){
                $qry.=" and (d.sku like '%".$_GET['search']."%' or 
                b.sku like '%".$_GET['search']."%' or 
                b.name like '%".$_GET['search']."%' or 
                h.ref_no like '%".$_GET['search']."' or 
                h.technical_report_no like '%".$_GET['search']."' or 
                h.remarks like '%".$_GET['search']."%' 
                )";
            }

            if(isset($_GET['receiver']) && strlen($_GET['receiver']) > 0){
                $qry.=" and (h.receiver_id like '%[".$_GET['receiver'].",%' or 
                h.receiver_id like '%,".$_GET['receiver']."]' or 
                h.receiver_id like '[".$_GET['receiver']."]' or 
                h.receiver_id like '%,".$_GET['receiver'].",%'               
                )";
            }
            if(isset($_GET['status']) && strlen($_GET['status']) > 0){
                $qry.=" and h.status = '".$_GET['status']."'";
            }
            if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and h.date_released >= '".$_GET['start_date']."'";
            }
            if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
                $qry.=" and h.date_released <= '".$_GET['end_date']."'";
            }

        }
        else{
            $qry = "SELECT DISTINCT h.*, d.* FROM par_details d 
                LEFT JOIN par_headers h ON h.id = d.par_header_id 
                LEFT JOIN items i ON i.id = d.item_id
                WHERE d.id > 0 AND h.employee_id = " . $id . " 
                ORDER BY h.id DESC";
        }
      

        $basicQuery = DB::select($qry);
    
        $transactions = $this->paginate($basicQuery);

        return view('theme.pages.custom.issuance.employees.show', compact('page', 'employee', 'filter', 'searchType', 'transactions'));
    }

    public function edit(Employee $employee)
    {
        $page = new Page();
        $page->name = "Employees";

        return view('theme.pages.custom.issuance.employees.edit', compact('page', 'employee'));
    }

    public function update(Request $request, Employee $employee)
    {
        $emp_id_exists = Employee::where('id', '<>', $employee->id)->where('emp_id', $employee->emp_id)->first();

        if($emp_id_exists == null){
            $employee->update([
                'name' => $request->name,
                'section_id' => $request->section_id,
                'department' => $request->department,
                'position' => $request->position,
                'emp_id' => $request->emp_id,
                'hired_date' => $request->hired_date,
            ]);

            // FOR FILE UPLOADS
            if($request->hasFile('avatar')){
                $avatar = $request->hasFile('avatar') ? FileHelper::move_to_files_folder($request->file('avatar'), 'attachments/employees/'. $request->emp_id)['url'] : null;
                $employee->update([
                    'avatar' => $avatar
                ]);
            }

            return redirect()->back()->with('alert', 'success:Well done! You successfully updated a employee');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Employee already exists');
        }
    }

    public function single_delete(Request $request)
    {
        $employee = Employee::findOrFail($request->employees);
        $employee->delete();

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted a employee');
    }

    public function multiple_delete(Request $request)
    {
        $employees = explode("|",$request->employees);

        foreach($employees as $employee){
            Employee::whereId((int) $employee)->delete();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted multiple employees');
    }

    public function single_restore(Request $request)
    {
        $employee = Employee::withTrashed()->findOrFail($request->employees);
        $employee->restore();

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored a employee');
    }

    public function multiple_restore(Request $request)
    {
        $employees = explode("|",$request->employees);

        foreach($employees as $employee){
            Employee::withTrashed()->whereId((int) $employee)->restore();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored multiple employees');
    }
    
}
