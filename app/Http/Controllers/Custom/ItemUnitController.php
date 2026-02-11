<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Facades\App\Helpers\ListingHelper;
use App\Helpers\ModelHelper;

use App\Models\{Page};
use App\Models\Custom\{ItemUnit};

class ItemUnitController extends Controller
{
    private $searchFields = ['name'];

    public function index()
    {
        $page = new Page();
        $page->name = "Item Units";
        
        $units = ListingHelper::simple_search(ItemUnit::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

       return view('theme.pages.custom.items.units.index', compact('page', 'units', 'filter', 'searchType'));
    }

    public function create()
    {
        $page = new Page();
        $page->name = "Item Unit";

       return view('theme.pages.custom.items.units.create', compact('page'));
    }

    public function store(Request $request)
    {
        $name_exists = ItemUnit::where('name', $request->name)->first();
        
        if($name_exists == null){
            $new_data = ItemUnit::create([
                'name' => $request->name,
                'slug' => ModelHelper::convert_to_slug(ItemUnit::class, $request->name),
                'description' => $request->description
            ]);
    
           return redirect()->route('items.units.index')->with('alert', 'success:Well done! You successfully added a unit');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function edit(ItemUnit $unit)
    {
        $page = new Page();
        $page->name = "Item Unit";

       return view('theme.pages.custom.items.units.edit', compact('page', 'unit'));
    }

    public function update(Request $request, ItemUnit $unit)
    {
        $name_exists = ItemUnit::where('id', '<>', $unit->id)->where('name', $request->name)->first();
        
        if($name_exists == null){
            $unit->update([
                'name' => $request->name,
                'slug' => ModelHelper::convert_to_slug(ItemUnit::class, $request->name),
                'description' => $request->description
            ]);

            return redirect()->back()->with('alert', 'success:Well done! You successfully updated a unit');
        }
        else{
            return redirect()->back()->with('alert', 'danger:Failed! Name already exists');
        }
    }

    public function single_delete(Request $request)
    {
        $unit = ItemUnit::findOrFail($request->units);
        $unit->delete();

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted an unit');
    }

    public function multiple_delete(Request $request)
    {
        $units = explode("|",$request->units);

        foreach($units as $unit){
            ItemUnit::whereId((int) $unit)->delete();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted multiple units');
    }

    public function single_restore(Request $request)
    {
        $unit = ItemUnit::withTrashed()->findOrFail($request->units);
        $unit->restore();

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored an unit');
    }

    public function multiple_restore(Request $request)
    {
        $units = explode("|",$request->units);

        foreach($units as $unit){
            ItemUnit::withTrashed()->whereId((int) $unit)->restore();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored multiple units');
    }
    
}
