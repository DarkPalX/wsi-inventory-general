<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Facades\App\Helpers\{FileHelper};

use App\Models\{Page, RolePermission};
use App\Models\Custom\{Item, ItemType, RequisitionHeader, RequisitionDetail, ReceivingHeader, ReceivingDetail, IssuanceHeader, IssuanceDetail, Receiver, Employee, ParHeader, ParDetail, ParBorrowedItem};
use Auth;
use DB;
use Carbon\Carbon;

class ParController extends Controller
{

    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page,  [
            'path' => Paginator::resolveCurrentPath()
        ]);
    }
    
    /**
     * Display a listing of the resource.
     */
    
    public function index()
    {
        $page = new Page();
        $page->name = "PAR Items";

        if(isset($_GET['is_search']) && $_GET['is_search']==1){
   
            $qry = "select d.*, h.*, d.id, e.name as 'emp_name', s.name as 'section_name', dv.name as 'division_name', i.name as 'item_name' from par_details d 
            left join par_headers h on h.id=d.par_header_id 
            left join employees e on e.id=h.employee_id 
            left join sections s on s.id=e.section_id 
            left join divisions dv on dv.id=s.division_id 
            left join items i on i.id=d.item_id 
            where d.id>0 and h.section_id=". Auth::user()->section_id . " ";

            if(isset($_GET['search']) && strlen($_GET['search']) > 0){
                $qry.=" and (d.sku like '%".$_GET['search']."%' or 
                i.sku like '%".$_GET['search']."%' or 
                i.name like '%".$_GET['search']."%' or 
                d.barcode like '%".$_GET['search']."%' or 
                h.remarks like '%".$_GET['search']."%' 
                )";
            }

            if(isset($_GET['receiver']) && strlen($_GET['receiver']) > 0){
                $qry.=" and (h.employee_id like '%".$_GET['receiver']."%'            
                )";
            }

            if(isset($_GET['division']) && strlen($_GET['division']) > 0){
                $qry.=" and (s.division_id like '%".$_GET['division']."%'            
                )";
            }

            if(isset($_GET['section']) && strlen($_GET['section']) > 0){
                $qry.=" and (e.section_id like '%".$_GET['section']."%'            
                )";
            }

            if(isset($_GET['status']) && strlen($_GET['status']) > 0){
                if($_GET['status'] != "ALL"){
                    $qry.=" and d.status = '".$_GET['status']."'";
                }
            }
            else{
                $qry.= " and d.status <> 'SURRENDERED'";
            }

            if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and d.created_at >= '".$_GET['start_date']."'";
            }
            
            if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
                $qry.=" and d.created_at <= '".$_GET['end_date']." 23:59:59'";
            }

        }
        else{
   
            $qry = "select d.*, h.*, d.id, e.name as 'emp_name', s.name as 'section_name', dv.name as 'division_name', i.name as 'item_name' from par_details d 
            left join par_headers h on h.id=d.par_header_id 
            left join employees e on e.id=h.employee_id 
            left join sections s on s.id=e.section_id 
            left join divisions dv on dv.id=s.division_id 
            left join items i on i.id=d.item_id 
            where d.id>0 and h.section_id=". Auth::user()->section_id . " and d.status NOT IN ('SURRENDERED', 'CLOSED')";

        }
        
        $qry .= " order by d.created_at desc";

        $basicQuery = DB::select($qry);
    
        $transactions = $this->paginate($basicQuery);
        return view('theme.pages.custom.par.index', compact('page', 'transactions'));
    }
    
    public function user_transactions()
    {
        $page = new Page();
        $page->name = "PAR Items";

        $qry = "select d.*, h.*, d.id, e.name as 'emp_name', s.name as 'section_name', dv.name as 'division_name', i.name as 'item_name' from par_details d 
        left join par_headers h on h.id=d.par_header_id 
        left join employees e on e.id=h.employee_id 
        left join sections s on s.id=e.section_id 
        left join divisions dv on dv.id=s.division_id 
        left join items i on i.id=d.item_id 
        where d.id>0 and e.user_id=". Auth::user()->id . " order by d.created_at desc";

        $basicQuery = DB::select($qry);
    
        $transactions = $this->paginate($basicQuery);
        return view('theme.pages.custom.par.index-user', compact('page', 'transactions'));
    }

    
    public function show($id)
    {
        $page = new Page();
        $page->name = "Par Item Details";

        $item = Item::find($id);
        $barcode = request('barcode');

        $par_history = ParDetail::where('barcode', $barcode)->orderByDesc('created_at')->get();
        $par_borrow_history = ParBorrowedItem::where('barcode', $barcode)->orderByDesc('date_borrowed')->get();

       return view('theme.pages.custom.par.show', compact('page', 'item', 'barcode', 'par_history', 'par_borrow_history'));
    }

    
    public function attachments($id)
    {
        $page = new Page();
        $page->name = "Par Item History Attachments";

        $par_detail = ParDetail::find($id);
        $item = Item::find($par_detail->item_id);

       return view('theme.pages.custom.par.attachments', compact('page', 'item', 'par_detail'));
    }
    

    public function upload(Request $request)
    {
        $par_detail= ParDetail::findOrFail($request->par_detail_id);

        // FOR PAR
        if($request->hasFile('par_attachment')){
            $par_attachment = $request->hasFile('par_attachment') ? FileHelper::move_to_files_folder($request->file('par_attachment'), 'attachments/par/items/'. $par_detail->id)['url'] : null;
            $par_detail->update([
                'par_attachment' => $par_attachment
            ]);
        }
        if($request->par_action == 'delete'){
            $par_detail->update([
                'par_attachment' => null
            ]);
        }


        // FOR PTR
        if($request->hasFile('ptr_attachment')){
            $ptr_attachment = $request->hasFile('ptr_attachment') ? FileHelper::move_to_files_folder($request->file('ptr_attachment'), 'attachments/par/items/'. $par_detail->id)['url'] : null;
            $par_detail->update([
                'ptr_attachment' => $ptr_attachment
            ]);
        }
        if($request->ptr_action == 'delete'){
            $par_detail->update([
                'ptr_attachment' => null
            ]);
        }

        return redirect()->back()->with('alert', 'success:Well done! You successfully uploaded an attachment');
    }
    

    public function single_close(Request $request)
    {
        $transaction = ParDetail::findOrFail($request->transactions);
        // ParDetail::create([
        //     'par_header_id' => $transaction->par_header_id,
        //     'item_id' => $transaction->item_id,
        //     'sku' => $transaction->sku,
        //     'barcode' => $transaction->barcode,
        //     'item_description' => $transaction->item_description,
        //     'price' => $transaction->price,
        //     'quantity' => $transaction->quantity,
        //     'status' => 'SURRENDERED',
        //     'remarks' => $request->remarks,
        //     'created_by' => Auth::user()->id
        // ]);

        $transaction->update([
            'status' => 'SURRENDERED',
            'remarks' => $request->remarks,
            'created_by' => Auth::user()->id
        ]);

        return redirect()->back()->with('alert', 'success:Well done! You successfully closed a PAR item');
    }
    

    public function single_transfer(Request $request)
    {
        $receiver = $request->employee_id;

        if (!str_contains($receiver, " : ")){
            return redirect()->back()->with('alert', 'danger:Failed! Check your accountable employees before saving');
        }
        $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();

        if(!$employee){
            return redirect()->back()->with('alert', 'danger:Failed! Check your accountable employees before saving');
        }

        $current_par_detail = ParDetail::findOrFail($request->transactions);
        $current_par_header = ParHeader::where('id', $current_par_detail->par_header_id)->first();

        $existing_par_header = ParHeader::where('employee_id', $employee->id)->where('issuance_header_id', $current_par_header->issuance_header_id)->first();

        // PAR HEADER
        if(!$existing_par_header){
            $requestData['employee_id'] = $employee->id;
            $requestData['section_id'] = Auth::user()->section_id;
            $requestData['issuance_header_id'] = $current_par_header->issuance_header_id;
            $requestData['created_by'] = Auth::user()->id;
            $par_header = ParHeader::create($requestData);
        }
        
        // PAR DETAIL
        $requestData['par_header_id'] = $par_header->id ?? $existing_par_header->id;
        $requestData['item_id'] = $current_par_detail->item_id;
        $requestData['sku'] = $current_par_detail->sku;
        $requestData['barcode'] = $current_par_detail->barcode;
        $requestData['item_description'] = $current_par_detail->item_description;
        $requestData['price'] = $current_par_detail->price;
        $requestData['quantity'] = $current_par_detail->quantity;
        $requestData['date_received'] =  now()->format('Y/m/d');
        $requestData['remarks'] = $request->remarks;
        $requestData['created_by'] = Auth::user()->id;
        
        ParDetail::create($requestData);   

        $current_par_detail->update([
            'transferred_to' => $employee->id,
            'date_transferred' => now(),
            'transfer_type' => $request->transfer_type,
            'transfer_specification' => $request->transfer_specification,
            'status' => 'CLOSED'
        ]);

        return redirect()->back()->with('alert', 'success:Well done! You successfully transferred a PAR item');
    }
    

    public function single_borrow(Request $request)
    {
        $receiver = $request->employee_id;

        if (!str_contains($receiver, " : ")){
            return redirect()->back()->with('alert', 'danger:Failed! Check your accountable employees before saving');
        }
        $employee = Employee::where('emp_id', explode(" : ", $receiver)[0])->where('name', explode(" : ", $receiver)[1])->first();

        if(!$employee){
            return redirect()->back()->with('alert', 'danger:Failed! Check your accountable employees before saving');
        }


        $current_par_detail = ParDetail::findOrFail($request->transactions);

        // PAR BORROW
        $requestData['par_detail_id'] = $current_par_detail->id;
        $requestData['item_id'] = $current_par_detail->item_id;
        $requestData['sku'] = $current_par_detail->sku;
        $requestData['barcode'] = $current_par_detail->barcode;
        $requestData['item_description'] = $current_par_detail->item_description;
        $requestData['employee_id'] = $employee->id;
        $requestData['date_borrowed'] = Carbon::now()->format('Y-m-d');
        $requestData['remarks'] = $request->remarks;
        $requestData['created_by'] = Auth::user()->id;
        
        ParBorrowedItem::create($requestData);   

        $current_par_detail->update([
            'borrowed_to' => $employee->id,
            'status' => 'BORROWED',
        ]);

        return redirect()->back()->with('alert', 'success:Well done! You successfully borrowed a PAR item');
    }
    

    public function single_return(Request $request)
    {

        $current_par_detail = ParDetail::findOrFail($request->transactions);
       
        ParBorrowedItem::where('par_detail_id', $current_par_detail->id)->where('barcode', $current_par_detail->barcode)->where('status', 'OPEN')
        ->update([
            'date_returned' => Carbon::now()->format('Y-m-d'),
            'status' => 'SURRENDERED',
            'remarks' => $request->remarks
        ]);

        $current_par_detail->update([
            'borrowed_to' => null,
            'status' => 'OPEN',
        ]);

        return redirect()->back()->with('alert', 'success:Well done! You successfully returned a PAR item');
    }

}
