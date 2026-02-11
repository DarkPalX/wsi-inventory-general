<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Http\Request;
use App\Http\Requests\IssuanceRequest;

use Facades\App\Helpers\{ListingHelper, FileHelper};


use App\Models\{Page, RolePermission};
use App\Models\Custom\{Item, ItemType, RequisitionHeader, RequisitionDetail, IssuanceHeader, IssuanceDetail, Receiver, Employee, ParHeader, ParDetail, Vehicle};
use Auth;
use DB;

class IssuanceController extends Controller

{
    private $searchFields = ['id'];

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
        $page->name = "Issuance Transactions";
   
        if(isset($_GET['is_search']) && $_GET['is_search']==1){

            $qry = "select distinct h.* from issuance_details d 
                    left join issuance_headers h on h.id=d.issuance_header_id 
                    left join items b on b.id=d.item_id
                    where d.id>0 and h.section_id=". Auth::user()->section_id . "  and h.ref_no IS NOT NULL";

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
            $qry = "select * from issuance_headers where section_id=". Auth::user()->section_id . " order by id desc";
        }
      

        $basicQuery = DB::select($qry);
    
        $transactions = $this->paginate($basicQuery);
        return view('theme.pages.custom.issuance.transactions.index', compact('page', 'transactions'));
    }

    public function index_old()
    {
        $page = new Page();
        $page->name = "Issuance Transactions";
    
        $transactions = ListingHelper::simple_search(IssuanceHeader::class, $this->searchFields);

        $filter = ListingHelper::get_filter($this->searchFields);

        $searchType = 'simple_search';

       return view('theme.pages.custom.issuance.transactions.index', compact('page', 'transactions', 'filter', 'searchType'));
    }

    public function create()
    {
        if(!RolePermission::has_permission(3,auth()->user()->role_id,1)){
            abort(403, 'Unauthorized action.');
        }

        $page = new Page();
        $page->name = "Issuance Transactions";

        $receivers = Receiver::all();
        $vehicles = Vehicle::all();

       return view('theme.pages.custom.issuance.transactions.create', compact('page', 'receivers', 'vehicles'));
    }

    public function store(IssuanceRequest $request)
    {
        $requestData = $request->validated();

        if(!$request->individual_receiver){
            return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Assign accountables on equipment items first before saving issuance');
        }

        foreach ($request->individual_receiver as $index => $receiver) {
            $item_type_id = $request->item_type_id[$index] ?? null;

            if($item_type_id == 2){
                if (!str_contains($receiver, " : ")){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Check your accountable employees before saving');
                }
                
                $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
            
                if(!$employee){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Check your accountable employees before saving');
                }
                
                $barcode_exists = ParDetail::where('barcode', $request->barcode[$index])->first();
            
                if($barcode_exists){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Item barcode already exists');
                }
            }
        }

        // ISSUANCE HEADER CREATION
        $requestData['ris_no'] = $request->ris_no;
        $requestData['section_id'] = Auth::user()->section_id;
        $requestData['posted_by'] = Auth::user()->id;
        $requestData['posted_at'] = now();
        $requestData['created_by'] = Auth::user()->id;
        $issuance_header = IssuanceHeader::create($requestData);

        $issuance_header->update([
            'ref_no' => IssuanceHeader::generateReferenceNo($issuance_header->id)
        ]);

        // FOR ATTACHMENTS UPLOAD
        if($request->hasFile('attachments')){
            $attachments_url = [];
            foreach ($request->file('attachments') as $attachment) {
                if ($attachment) {
                    $attachment_url = FileHelper::move_to_files_folder($attachment, 'attachments/issuance-transactions/attachments/' . $issuance_header->id)['url'];
                    $attachments_url[] = $attachment_url;
                }
            }

            $issuance_header->update([
                'attachments' => json_encode($attachments_url, JSON_UNESCAPED_SLASHES)
            ]);
        }

        // ISSUANCE DETAILS CREATION
        $item_count = 0;
        foreach($request->item_id as $item){
            if($item > 0){
                $requestData['issuance_header_id'] = $issuance_header->id;
                $requestData['item_id'] = $item;
                $requestData['sku'] = $request->sku[$item_count];
                $requestData['item_type_id'] = $request->item_type_id[$item_count];
                $requestData['quantity'] = $request->quantity[$item_count];
                $requestData['cost'] = $request->cost[$item_count] ?? 0;
                $requestData['issued_by'] = Auth::user()->id;
                $requestData['issued_at'] = now();
                $requestData['received_by'] = Employee::getEmployeeId($request->individual_receiver[$item_count] ?? null);
                $requestData['received_at'] = now();
    
                IssuanceDetail::create($requestData);
    
                $item_count++;
            }
        }

        //PAR CREATION
        $individual_receiver_index = 0;
        foreach($request->individual_receiver as $receiver){

            $item_type_id = $request->item_type_id[$individual_receiver_index];
            if($item_type_id == 2){

                $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
                $existing_par_header = ParHeader::where('employee_id', $employee->id)->where('issuance_header_id', $issuance_header->id)->first();

                // PAR HEADER
                if(!$existing_par_header){
                    $requestData['employee_id'] = $employee->id;
                    $requestData['section_id'] = Auth::user()->section_id;
                    $requestData['issuance_header_id'] = $issuance_header->id;
                    $requestData['created_by'] = Auth::user()->id;
                    $par_header = ParHeader::create($requestData);
                }
                
                // PAR DETAIL
                $requestData['par_header_id'] = $par_header->id ?? $existing_par_header->id;
                $requestData['item_id'] = $request->item_id[$individual_receiver_index];
                $requestData['sku'] = $request->sku[$individual_receiver_index];
                $requestData['barcode'] = $request->barcode[$individual_receiver_index];
                $requestData['item_description'] = $request->item_name[$individual_receiver_index];
                $requestData['price'] = $request->cost[$individual_receiver_index] ?? 0;
                $requestData['quantity'] = $request->quantity[$individual_receiver_index];
                $requestData['date_received'] =  now()->format('Y/m/d');

                ParDetail::create($requestData);   
            }
            
            $individual_receiver_index++;
        }

       return redirect()->route('issuance.requisitions.index')->with('alert', 'success:Well done! You successfully added a transaction');
    }
    
    public function show(Request $request)
    {
        $page = new Page();
        $page->name = "Issuance Transactions";

        $transaction = IssuanceHeader::withTrashed()->findOrFail($request->query('id'));

        $receivers = Receiver::all();
        $issuance_details = IssuanceDetail::where('issuance_header_id', $transaction->id)->get();

        return view('theme.pages.custom.issuance.transactions.show', compact('transaction', 'page', 'receivers', 'issuance_details'));
    }
    
    // public function show(IssuanceHeader $transaction)
    // {
    //     $page = new Page();
    //     $page->name = "Issuance Transactions";

    //     $receivers = Receiver::all();
    //     $issuance_details = IssuanceDetail::where('issuance_header_id', $transaction->id)->get();

    //     return view('theme.pages.custom.issuance.transactions.show', compact('transaction', 'page', 'receivers', 'issuance_details'));
    // }

    
    public function print_barcode(Request $request)
    {
        $issuance_header = IssuanceHeader::where('ris_no', request('ris_no'))->first();
        $par_headers = ParHeader::where('issuance_header_id', $issuance_header->id)->get();

        return view('theme.pages.custom.issuance.transactions.print-barcode', compact('issuance_header', 'par_headers'));
    }

    public function edit(IssuanceHeader $transaction)
    {
        if(!RolePermission::has_permission(3,auth()->user()->role_id,1)){
            abort(403, 'Unauthorized action.');
        }
        
        $page = new Page();
        $page->name = "Issuance Transactions";

        $receivers = Receiver::all();
        $vehicles = Vehicle::all();
        $issuance_details = IssuanceDetail::where('issuance_header_id', $transaction->id)->get();

        return view('theme.pages.custom.issuance.transactions.edit', compact('transaction', 'page', 'receivers', 'vehicles', 'issuance_details'));
    }

    public function update(IssuanceRequest $request, IssuanceHeader $transaction)
    {
        $requestData = $request->validated();

        foreach ($request->individual_receiver as $index => $receiver) {
            $item_type_id = $request->item_type_id[$index] ?? null;

            if($item_type_id == 2){
                if (!str_contains($receiver, " : ")){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Check your accountable employees before saving');
                }
                
                $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
            
                if(!$employee){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Check your accountable employees before saving');
                }
                
                $barcode_exists = ParDetail::where('barcode', $request->barcode[$index])
                    ->join('par_headers', 'par_headers.id', 'par_details.par_header_id')
                    ->where('par_headers.issuance_header_id','<>', $transaction->id)
                    ->first();
            
                if($barcode_exists){
                    return redirect()->route('issuance.requisitions.index')->with('alert', 'danger:Failed! Item barcode already exists');
                }
            }
        }

        // ISSUANCE HEADER UPDATE
        $updateData['updated_by'] = Auth::user()->id;
        $issuance_header = IssuanceHeader::where('id', $transaction->id )->update($updateData);

        // FOR ATTACHMENTS UPLOAD
        if($request->hasFile('attachments')){
            $attachments_url = [];
            foreach ($request->file('attachments') as $attachment) {
                if ($attachment) {
                    $attachment_url = FileHelper::move_to_files_folder($attachment, 'attachments/issuance-transactions/attachments/' . $transaction->id)['url'];
                    $attachments_url[] = $attachment_url;
                }
            }

            $issuance_header->update([
                'attachments' => json_encode($attachments_url, JSON_UNESCAPED_SLASHES)
            ]);
        }

        // ISSUANCE DETAILS CREATION
        IssuanceDetail::where('issuance_header_id', $transaction->id)->delete();
        $item_count = 0;
        foreach($request->item_id as $item){
            if($item > 0){
                $requestData['issuance_header_id'] = $transaction->id;
                $requestData['item_id'] = $item;
                $requestData['sku'] = $request->sku[$item_count];
                $requestData['item_type_id'] = $request->item_type_id[$item_count];
                $requestData['quantity'] = $request->quantity[$item_count];
                $requestData['cost'] = $request->cost[$item_count] ?? 0;
                $requestData['issued_by'] = Auth::user()->id;
                $requestData['issued_at'] = now();
                $requestData['received_by'] = Employee::getEmployeeId($request->individual_receiver[$item_count] ?? null);
                $requestData['received_at'] = now();
    
                IssuanceDetail::create($requestData);
    
                $item_count++;
            }
        }

        //PAR CREATION
        $current_par_header = ParHeader::where('issuance_header_id', $transaction->id)->get();
        foreach($current_par_header as $c_par_header){
            ParDetail::where('par_header_id', $c_par_header->id)->delete();
            ParHeader::where('issuance_header_id', $transaction->id)->delete();
        }

        $individual_receiver_index = 0;
        foreach($request->individual_receiver as $receiver){

            $item_type_id = $request->item_type_id[$individual_receiver_index];
            if($item_type_id == 2){

                $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
                $existing_par_header = ParHeader::where('employee_id', $employee->id)->where('issuance_header_id', $transaction->id)->first();

                // PAR HEADER
                if(!$existing_par_header){
                    $requestData['employee_id'] = $employee->id;
                    $requestData['section_id'] = Auth::user()->section_id;
                    $requestData['issuance_header_id'] = $transaction->id;
                    $requestData['created_by'] = Auth::user()->id;
                    $par_header = ParHeader::create($requestData);
                }
                
                // PAR DETAIL
                $requestData['par_header_id'] = $par_header->id ?? $existing_par_header->id;
                $requestData['item_id'] = $request->item_id[$individual_receiver_index];
                $requestData['barcode'] = $request->barcode[$individual_receiver_index];
                $requestData['item_description'] = $request->item_name[$individual_receiver_index];
                $requestData['price'] = $request->cost[$individual_receiver_index] ?? 0;
                $requestData['quantity'] = $request->quantity[$individual_receiver_index];

                ParDetail::create($requestData);

            }
            
            $individual_receiver_index++;
        }

       return redirect()->route('issuance.requisitions.index')->with('alert', 'success:Well done! You successfully updated a transaction');
    }

    public function update_old(IssuanceRequest $request, IssuanceHeader $transaction)
    {
        $requestData = $request->validated();

        foreach($request->individual_receiver as $receiver){
            if (!str_contains($receiver, " : ")) { return back()->with('alert', 'danger:Failed! Check your accountable employees before saving'); }
            
            $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
        
            if(!$employee){ return back()->with('alert', 'danger:Failed! Check your accountable employees before saving'); }
        }

        // ISSUANCE HEADER CREATION
        $requestData['updated_by'] = Auth::user()->id;
        $requestData['is_for_sale'] = $request->is_for_sale ? 1 : 0;
        $issuance_header = $transaction->update($requestData);


        // FOR RECEIVER
        $receiver_ids = [];
        if (!empty($request->receiver_id)) {
            foreach ($request->receiver_id as $receiver) {
                if (filter_var($receiver, FILTER_VALIDATE_INT) === false) {
                    $new_receiver = Receiver::create([
                        'name' => $receiver
                    ]);
                    $receiver_ids[] = $new_receiver->id;
                } else {
                    $receiver_ids[] = (int)$receiver;
                }
            }

            $transaction->update([
                'receiver_id' => json_encode($receiver_ids, JSON_UNESCAPED_SLASHES)
            ]);
        }

        // FOR VEHICLE
        if (!empty($request->vehicle_id)) {

            $vehicle = $request->vehicle_id;

            if(filter_var($vehicle, FILTER_VALIDATE_INT) == false){
                $new_vehicle = Vehicle::create([
                    // 'name' => $vehicle,
                    // 'slug' => ModelHelper::convert_to_slug(Vehicle::class, $vehicle),
                    'plate_no' => $vehicle,
                    'description' => $vehicle,
                ]);
                $vehicle = $new_vehicle->id;
            }

            $transaction->update([
                'vehicle_id' => $vehicle
            ]);
        }

        // FOR ATTACHMENTS UPLOAD
        if($request->hasFile('attachments')){
            $attachments_url = [];
            foreach ($request->file('attachments') as $attachment) {
                if ($attachment) {
                    $attachment_url = FileHelper::move_to_files_folder($attachment, 'attachments/issuance-transactions/attachments/' . $transaction->id)['url'];
                    $attachments_url[] = $attachment_url;
                }
            }

            $transaction->update([
                'attachments' => json_encode($attachments_url, JSON_UNESCAPED_SLASHES)
            ]);
        }

        // ISSUANCE DETAILS CREATION
        IssuanceDetail::where('issuance_header_id', $transaction->id)->delete();
        $item_count = 0;
        foreach($request->item_id as $item){
            if($item > 0){
                $requestData['issuance_header_id'] = $transaction->id;
                $requestData['item_id'] = $item;
                $requestData['sku'] = $request->sku[$item_count];
                $requestData['quantity'] = $request->quantity[$item_count];
                $requestData['cost'] = $request->cost[$item_count];
                $requestData['price'] = $request->price[$item_count];
    
                IssuanceDetail::create($requestData);
    
                $item_count++;
            }
        }
        
        // ERRRRRORRRRRRRR HWEEEEEEREEEEEEE

        //PAR CREATION
        $current_par_header = ParHeader::where('issuance_header_id', $transaction->id)->get();
        foreach($current_par_header as $c_par_header){
            ParDetail::where('par_header_id', $c_par_header->id)->delete();
            ParHeader::where('issuance_header_id', $transaction->id)->delete();
        }

        $individual_receiver_index = 0;
        foreach($request->individual_receiver as $receiver){

            $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();
            $existing_par_header = ParHeader::where('employee_id', $employee->id)->where('issuance_header_id', $transaction->id)->first();


            // PAR HEADER
            if(!$existing_par_header){
                $requestData['employee_id'] = $employee->id;
                $requestData['issuance_header_id'] = $transaction->id;
                $requestData['created_by'] = Auth::user()->id;
                $par_header = ParHeader::create($requestData);
            }

            // PAR DETAIL
            $requestData['par_header_id'] = $par_header->id ?? $existing_par_header->id;
            $requestData['item_id'] = $request->item_id[$individual_receiver_index];
            $requestData['item_description'] = $request->item_name[$individual_receiver_index];
            $requestData['price'] = $request->price[$individual_receiver_index];
            $requestData['quantity'] = $request->quantity[$individual_receiver_index];

            ParDetail::create($requestData);      

            $individual_receiver_index++;
        }

       return redirect()->route('issuance.transactions.index')->with('alert', 'success:Well done! You successfully updated a transaction');
    }

    public function single_delete(Request $request)
    {
        $transaction = IssuanceHeader::findOrFail($request->transactions);

        $transaction->update([
            'status' => 'CANCELLED',
            'cancelled_by' => Auth::user()->id,
            'cancelled_at' => now()
        ]);

        $transaction->delete();

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted a transaction');
    }

    public function multiple_delete(Request $request)
    {
        $transactions = explode("|",$request->transactions);

        foreach($transactions as $transaction){

            IssuanceHeader::where('id', $transaction)
            ->update([
                'status' => 'CANCELLED',
                'cancelled_by' => Auth::user()->id,
                'cancelled_at' => now()
            ]);

            IssuanceHeader::whereId((int) $transaction)->delete();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully deleted multiple transactions');
    }

    public function single_restore(Request $request)
    {
        $transaction = IssuanceHeader::withTrashed()->findOrFail($request->transactions);
        $transaction->restore();

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored a transaction');
    }

    public function multiple_restore(Request $request)
    {
        $transactions = explode("|",$request->transactions);

        foreach($transactions as $transaction){
            IssuanceHeader::withTrashed()->whereId((int) $transaction)->restore();
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully restored multiple transactions');
    }

    public function single_post(Request $request)
    {
        $transaction = IssuanceHeader::findOrFail($request->transactions);
        $transaction->update([
            'status' => 'POSTED',
            'posted_by' => Auth::user()->id,
            'posted_at' => now()
        ]);

        return redirect()->back()->with('alert', 'success:Well done! You successfully posted a transaction');
    }

    // public function search_item(Request $request)
    // {
    //     // Perform the search query, using 'like' for partial matches
    //     $query = $request->input('query');
    //     $results = Item::where('id', 'like', '%' . $query . '%')
    //                     ->orWhere('sku', 'like', '%' . $query . '%')
    //                     ->orWhere('name', 'like', '%' . $query . '%')
    //                     ->get(['id', 'sku', 'name', 'total_cost', 'total_price']); // Select only the necessary fields

    //     // Filter out items with inventory equal to 0 and include the inventory in the response
    //     $filteredResults = $results->filter(function ($item) {
    //         $item->inventory = $item->inventory; // Access the inventory attribute
    //         return $item->inventory > 0; // Only include items with inventory greater than 0
    //     });

    //     return response()->json(['results' => $filteredResults->values()]);
    // }

    public function search_item(Request $request)
    {
        // Perform the search query, using 'like' for partial matches
        $query = $request->input('query');
        $results = Item::where('items.id', 'like', '%' . $query . '%')
                        ->orWhere('items.sku', 'like', '%' . $query . '%')
                        ->orWhere('items.name', 'like', '%' . $query . '%')
                        ->leftJoin('item_types', 'items.type_id', '=', 'item_types.id')
                        ->get(['items.id', 'items.sku', 'items.name', 'item_types.name as unit']); // Select only the necessary fields
                        // ->get(['items.id', 'items.sku', 'items.name', 'item_types.name as unit', 'items.price']); // Select only the necessary fields

        // Filter out items with inventory equal to 0 and include the inventory in the response
        $filteredResults = $results->filter(function ($item) {
            $item->inventory = $item->inventory; // Access the inventory attribute
            return $item->inventory > 0; // Only include items with inventory greater than 0
        });

        return response()->json(['results' => $filteredResults->values()]);
    }

    public function search_receiver(Request $request)
    {
        // Perform the search query, using 'like' for partial matches
        $query = $request->input('q');

        $results = Employee::where('name', 'like', '%' . $query . '%')
                    ->orWhere('emp_id', 'like', '%' . $query . '%')
                    ->get(['id', 'emp_id', 'name']);

        return response()->json(['results' => $results]);
    }

    public function search_existing_barcode(Request $request)
    {
        $query = $request->input('q');
        $issuance_id = $request->input('id', 0);

        $result = ParDetail::where('barcode', $query)
            ->join('par_headers', 'par_headers.id', '=', 'par_details.par_header_id')
            ->where('par_headers.issuance_header_id', '<>', $issuance_id)
            ->select('par_details.*')
            ->first();

        return response()->json(['results' => $result]);
    }
    
}
