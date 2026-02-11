<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;

use App\Models\{Page};
use App\Models\Custom\{Division, Employee};

class DivisionController extends Controller
{
    private $searchFields = ['name'];

    public function index()
    {
        $page = new Page();
        $page->name = "Divisions";
        
        $divisions = ListingHelper::simple_search(Division::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        $employees = Employee::all();

       return view('theme.pages.custom.accounts.divisions.index', compact('page', 'divisions', 'filter', 'searchType', 'employees'));
    }

    public function create()
    {
        $page = new Page();
        $page->name = "Division";

       return view('theme.pages.custom.accounts.divisions.create', compact('page'));
    }

    public function store(Request $request)
    {
        $name_exists = Division::where('name', $request->name)->first();
        
        if($name_exists == null){
            $new_data = Division::create([
                'name' => $request->name,
                'head_emp_id' => $request->head_emp_id,
            ]);
    
           return redirect()->route('accounts.divisions.index')->with('alert', 'success:Well done! You successfully added a division');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function edit(Division $division)
    {
        $page = new Page();
        $page->name = "Division";

       return view('theme.pages.custom.accounts.divisions.edit', compact('page', 'division'));
    }

    public function update(Request $request, Division $division)
    {
        $name_exists = Division::where('id', '<>', $division->id)->where('name', $request->name)->first();
        
        if($name_exists == null){
            $division->update([
                'name' => $request->name,
                'head_emp_id' => $request->head_emp_id,
            ]);

            return redirect()->back()->with('alert', 'success:Well done! You successfully updated a division');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function single_delete(Request $request)
    {
        $division = Division::findOrFail($request->divisions);
        $division->delete();

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted an division');
    }

    public function multiple_delete(Request $request)
    {
        $divisions = explode("|",$request->divisions);

        foreach($divisions as $division){
            Division::whereId((int) $division)->delete();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted multiple divisions');
    }

    public function single_restore(Request $request)
    {
        $division = Division::withTrashed()->findOrFail($request->divisions);
        $division->restore();

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored an division');
    }

    public function multiple_restore(Request $request)
    {
        $divisions = explode("|",$request->divisions);

        foreach($divisions as $division){
            Division::withTrashed()->whereId((int) $division)->restore();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored multiple divisions');
    }
    
}

