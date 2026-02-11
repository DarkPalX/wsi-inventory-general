<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;

use App\Models\{Page};
use App\Models\Custom\{Section, Division, Employee};

class SectionController extends Controller
{
    private $searchFields = ['name'];

    public function index()
    {
        $page = new Page();
        $page->name = "Sections";
        
        $sections = ListingHelper::simple_search(Section::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

        $employees = Employee::all();
        $divisions = Division::all();

       return view('theme.pages.custom.accounts.sections.index', compact('page', 'sections', 'filter', 'searchType', 'employees', 'divisions'));
    }

    public function create()
    {
        $page = new Page();
        $page->name = "Section";

       return view('theme.pages.custom.accounts.sections.create', compact('page'));
    }

    public function store(Request $request)
    {
        $name_exists = Section::where('name', $request->name)->first();
        
        if($name_exists == null){
            $new_data = Section::create([
                'name' => $request->name,
                'division_id' => $request->division_id,
                'head_emp_id' => $request->head_emp_id,
                'secretary_emp_id' => $request->secretary_emp_id,
            ]);
    
           return redirect()->route('accounts.sections.index')->with('alert', 'success:Well done! You successfully added a section');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function edit(Section $section)
    {
        $page = new Page();
        $page->name = "Section";

       return view('theme.pages.custom.accounts.sections.edit', compact('page', 'section'));
    }

    public function update(Request $request, Section $section)
    {
        $name_exists = Section::where('id', '<>', $section->id)->where('name', $request->name)->first();
        
        if($name_exists == null){
            $section->update([
                'name' => $request->name,
                'division_id' => $request->division_id,
                'head_emp_id' => $request->head_emp_id,
                'secretary_emp_id' => $request->secretary_emp_id,
            ]);

            return redirect()->back()->with('alert', 'success:Well done! You successfully updated a section');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function single_delete(Request $request)
    {
        $section = Section::findOrFail($request->sections);
        $section->delete();

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted an section');
    }

    public function multiple_delete(Request $request)
    {
        $sections = explode("|",$request->sections);

        foreach($sections as $section){
            Section::whereId((int) $section)->delete();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted multiple sections');
    }

    public function single_restore(Request $request)
    {
        $section = Section::withTrashed()->findOrFail($request->sections);
        $section->restore();

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored an section');
    }

    public function multiple_restore(Request $request)
    {
        $sections = explode("|",$request->sections);

        foreach($sections as $section){
            Section::withTrashed()->whereId((int) $section)->restore();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored multiple sections');
    }
    
}
