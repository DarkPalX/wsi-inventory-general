<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Facades\App\Helpers\{ListingHelper, FileHelper};

use App\Models\{Page};
use App\Models\Custom\{Item, ItemCategory, ItemAuthor, IssuanceHeader, IssuanceDetail, Receiver, ReceivingHeader, ReceivingDetail};
use App\Models\{User, ActivityLog};
use Auth;
use DB;


class ReportsController extends Controller

{
    private $paginate = 1000;
    private $searchFields = ['id'];

    public function issuance(){
        $page = new Page();
        $page->name = "Issuance Report";

        $qry = "select h.*,d.*,b.*,b.name as bname, h.created_at as hcreated, h.id as hid, b.sku as bsku
                    from issuance_details d 
                    left join issuance_headers h on h.id=d.issuance_header_id 
                    left join items b on b.id=d.item_id
                    where d.id>0 AND h.ref_no IS NOT NULL";

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
            h.receiver_id like '%".$_GET['receiver']."%' or 
            h.receiver_id like '%,".$_GET['receiver']."]' or 
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

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.issuance', compact('rs','page'));
    }

    public function requisitions(){
        $page = new Page();
        $page->name = "Requisition Report";

        if(isset($_GET['is_search']) && $_GET['is_search']==1){

            $qry = "select h.*,d.*,i.name as itemname, i.sku as itemsku, h.updated_at as hupd, h.created_at as hcr from requisition_details d 
                    left join requisition_headers h on h.id=d.requisition_header_id 
                    left join items i on i.id=d.item_id
                    where d.id>0 ";

            if(isset($_GET['search']) && strlen($_GET['search']) > 0){
                $qry.=" and (d.sku like '%".$_GET['search']."%' or 
                i.sku like '%".$_GET['search']."%' or 
                i.name like '%".$_GET['search']."%' or 
                h.ref_no like '%".$_GET['search']."%' or 
                h.purpose like '%".$_GET['search']."%' or 
                h.remarks like '%".$_GET['search']."%' 
                )";
            }
            if(isset($_GET['requester']) && strlen($_GET['requester']) > 0){
                $qry.=" and h.requested_by = '".$_GET['requester']."'";
            }
            if(isset($_GET['status']) && strlen($_GET['status']) > 0){
                $qry.=" and h.status = '".$_GET['status']."'";
            }
            if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and h.date_requested >= '".$_GET['start_date']."'";
            }
            if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
                $qry.=" and h.date_requested <= '".$_GET['end_date']."'";
            }

        }
        else{
            $qry = "select h.*,d.*,i.name as itemname, i.sku as itemsku, h.updated_at as hupd, h.created_at as hcr from requisition_details d 
                    left join requisition_headers h on h.id=d.requisition_header_id 
                    left join items i on i.id=d.item_id where 1=1 ";
        }

        if(Auth::user()->role_id == env('APPROVER_ROLE_ID') || Auth::user()->role_id == env('SECRETARY_ROLE_ID')){
            $qry .= " and h.section_id=". Auth::user()->section_id . "";
        }

        if(Auth::user()->role_id == env('WAREHOUSE_ROLE_ID')){
            $qry .= " and h.status='POSTED'";
        }

        $qry .= " order by h.updated_at desc";
        

        $rs = DB::select($qry);
        //dd($rs);
        //$rs = $this->paginate($basicQuery);
    
       return view('theme.pages.custom.reports.requisition', compact('rs','page'));
    }

    public function receiving(){
        $page = new Page();
        $page->name = "Receiving Stock Report";

        $qry = "select h.*,d.*,b.*,b.name as bname, h.created_at as hcreated, h.id as hid, b.sku as bsku
                    from receiving_details d 
                    left join receiving_headers h on h.id=d.receiving_header_id 
                    left join items b on b.id=d.item_id
                    where d.id>0";

        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
            $qry.=" and (d.sku like '%".$_GET['search']."%' or 
            b.sku like '%".$_GET['search']."%' or 
            b.name like '%".$_GET['search']."%' or 
            h.ref_no like '%".$_GET['search']."' or 
            h.po_number like '%".$_GET['search']."' or 
            h.si_number like '%".$_GET['search']."' or 
            h.remarks like '%".$_GET['search']."%' 
            )";
        }

        if(isset($_GET['supplier']) && strlen($_GET['supplier']) > 0){
            $qry.=" and (h.supplier_id like '%[".$_GET['supplier'].",%' or 
            h.supplier_id like '%".$_GET['supplier']."%' or 
            h.supplier_id like '%,".$_GET['supplier']."]' or 
            h.supplier_id like '%,".$_GET['supplier'].",%'               
            )";
        }

        if(isset($_GET['status']) && strlen($_GET['status']) > 0){
            $qry.=" and h.status = '".$_GET['status']."'";
        }
        if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and h.date_received >= '".$_GET['start_date']."'";
        }
        if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
            $qry.=" and h.date_received <= '".$_GET['end_date']."'";
        }

        $rs = DB::select($qry);

       return view('theme.pages.custom.reports.receiving', compact('rs','page'));
    }

    public function receivables(){
        $page = new Page();
        $page->name = "Receivables Report";

        $qry = "select h.*,d.*,b.*,b.name as bname, h.created_at as hcreated, h.id as hid, b.sku as bsku
                    from purchase_order_details d 
                    left join purchase_order_headers h on h.id=d.purchase_order_header_id 
                    left join items b on b.id=d.item_id
                    where d.id>0 AND d.remaining > 0";

        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
            $qry.=" and (d.sku like '%".$_GET['search']."%' or 
            b.sku like '%".$_GET['search']."%' or 
            b.name like '%".$_GET['search']."%' or 
            h.ref_no like '%".$_GET['search']."' or 
            h.remarks like '%".$_GET['search']."%' 
            )";
        }

        if(isset($_GET['supplier']) && strlen($_GET['supplier']) > 0){
            $qry.=" and (h.supplier_id like '%[".$_GET['supplier'].",%' or 
            h.supplier_id like '%".$_GET['supplier']."%' or 
            h.supplier_id like '%,".$_GET['supplier']."]' or 
            h.supplier_id like '%,".$_GET['supplier'].",%'               
            )";
        }

        if(isset($_GET['status']) && strlen($_GET['status']) > 0){
            $qry.=" and h.status = '".$_GET['status']."'";
        }
        if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and h.date_ordered >= '".$_GET['start_date']."'";
        }
        if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
            $qry.=" and h.date_ordered <= '".$_GET['end_date']."'";
        }

        $rs = DB::select($qry);

       return view('theme.pages.custom.reports.receivables', compact('rs','page'));
    }

    public function stock_card(Request $request){

        $page = new Page();
        $page->name = "Stock Card";

        $items = Item::all();

        if($request->all() != []){

            $item = Item::find($request->id);

            $receiving_transactions = ReceivingHeader::where('receiving_headers.status', 'POSTED')
            ->join('receiving_details', 'receiving_details.receiving_header_id', '=', 'receiving_headers.id')
            ->where('receiving_details.item_id', $request->id)
            ->select('receiving_headers.posted_at', 'receiving_details.quantity', 'receiving_headers.id', 'receiving_headers.ref_no', DB::raw("'Receiving' as type"))
            ->get();

            $issuance_transactions = IssuanceHeader::where('issuance_headers.status', 'POSTED')
            ->join('issuance_details', 'issuance_details.issuance_header_id', '=', 'issuance_headers.id')
            ->where('issuance_details.item_id', $request->id)
            ->select('issuance_headers.posted_at', 'issuance_details.quantity', 'issuance_headers.id', 'issuance_headers.ref_no', DB::raw("'Issuance' as type"))
            ->get();

            //$transactions = $receiving_transactions->merge($issuance_transactions);
            $transactions = collect();
            $transactions = $transactions->merge($receiving_transactions)->merge($issuance_transactions);

            $sorted_transactions = $transactions->sortBy('posted_at')->values();

            $running_balance = 0;
            $stock_card = [];

            foreach ($sorted_transactions as $transaction) {
                if ($transaction->type === 'Receiving') {
                    $running_balance += $transaction->quantity;
                } else if ($transaction->type === 'Issuance') {
                    $running_balance -= $transaction->quantity;
                }

                $stock_card[] = [
                    'date' => $transaction->posted_at,
                    'type' => $transaction->type,
                    'transaction_id' => $transaction->id,
                    'ref_no' => $transaction->ref_no,
                    'quantity' => $transaction->quantity,
                    'running_balance' => $running_balance
                ];
            }

        }
        else{
            $item = new Item();
            $item->id = null;
            $item->name = null;
            $item->Inventory = null;

            $stock_card = [];
        }

        

       return view('theme.pages.custom.reports.stock-card', compact('page', 'items', 'item', 'stock_card'));
    }

    public function inventory(){
        $page = new Page();
        $page->name = "Inventory Report";

        $qry = "select b.*,c.*,b.id as bid, b.name as bname, c.name as cname, u.name as unit
                    from items b
                    left join item_categories c on c.id = b.category_id
                    left join item_types u on u.id = b.type_id
                    where b.id>0";

        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
            $qry.=" and (b.sku like '%".$_GET['search']."%' or 
            b.name like '%".$_GET['search']."%'
            )";
        }

        if(isset($_GET['category']) && strlen($_GET['category']) > 0){
            $qry.=" and (c.id like '%[".$_GET['category'].",%' or 
            c.id like '%".$_GET['category']."%' or 
            c.id like '%,".$_GET['category']."]' or 
            c.id like '%,".$_GET['category'].",%'               
            )";
        }

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.inventory', compact('rs','page'));
    }

    public function users(){
        $page = new Page();
        $page->name = "User Report";

        $qry = "select u.*, r.*, u.name as uname, r.name as rname
                    from users u
                    left join roles r on r.id = u.role_id
                    where u.id>0";


        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
            $qry.=" and (u.name like '%".$_GET['search']."%' or
            u.email like '%".$_GET['search']."%'
            )";
        }

        if(isset($_GET['role']) && strlen($_GET['role']) > 0){
            $qry.=" and (r.id like '%[".$_GET['role'].",%' or 
            r.id like '%".$_GET['role']."%' or 
            r.id like '%,".$_GET['role']."]' or 
            r.id like '%,".$_GET['role'].",%'               
            )";
        }

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.users', compact('rs','page'));
    }

    public function audit_trail(){
        $page = new Page();
        $page->name = "Audit Trail";

        $qry = "select a.*,u.*
                    from activity_logs a
                    left join users u on u.id = a.log_by
                    where a.id>0";


        if(isset($_GET['search']) && strlen($_GET['search']) > 0){
            $qry.=" and (a.activity_desc like '%".$_GET['search']."%')";
        }

        if(isset($_GET['user']) && strlen($_GET['user']) > 0){
            $qry.=" and (u.id like '%[".$_GET['user'].",%' or 
            u.id like '%".$_GET['user']."%' or 
            u.id like '%,".$_GET['user']."]' or 
            u.id like '%,".$_GET['user'].",%'               
            )";
        }

        if(isset($_GET['start_date']) && strlen($_GET['start_date']) > 0){
                $qry.=" and a.activity_date >= '".$_GET['start_date']."'";
        }
        if(isset($_GET['end_date']) && strlen($_GET['end_date']) > 0){
            $qry.=" and a.activity_date <= '".$_GET['end_date']."'";
        }

        $rs = DB::select($qry);

       return view('theme.pages.custom.reports.audit-trail', compact('rs','page'));
    }

    public function items(){
        $page = new Page();
        $page->name = "Item List Report";

        $qry = "SELECT b.id as bid, b.name as bname, b.sku, b.created_at, 
                    u.name as unit,
                    c.name as cname
                FROM items b
                LEFT JOIN item_categories c ON c.id = b.category_id
                LEFT JOIN item_types u ON u.id = b.type_id
                WHERE b.id > 0";

        if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
            $qry .= " AND (b.sku LIKE '%".$_GET['search']."%' OR 
                        b.name LIKE '%".$_GET['search']."%')";
        }

        if(isset($_GET['category']) && strlen($_GET['category']) > 0) {
            $qry .= " AND c.id = ".$_GET['category'];
        }

        // Add all non-aggregated columns to the GROUP BY clause
        $qry .= " GROUP BY b.id, b.name, b.sku, b.created_at, c.name, u.name";

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.items', compact('rs','page'));
    }

    public function deficit_items(){
        $page = new Page();
        $page->name = "Below Minimum Stock Report";

        $qry = "SELECT b.id as bid, b.name as bname, b.sku, b.minimum_stock, b.created_at, 
                    u.name as unit,
                    c.name as cname
                FROM items b
                LEFT JOIN item_categories c ON c.id = b.category_id
                LEFT JOIN item_types u ON u.id = b.type_id
                WHERE b.id > 0 AND b.minimum_stock > 0";

        if(isset($_GET['search']) && strlen($_GET['search']) > 0) {
            $qry .= " AND (b.sku LIKE '%".$_GET['search']."%' OR 
                        b.name LIKE '%".$_GET['search']."%')";
        }

        if(isset($_GET['category']) && strlen($_GET['category']) > 0) {
            $qry .= " AND c.id = ".$_GET['category'];
        }

        // Add all non-aggregated columns to the GROUP BY clause
        $qry .= " GROUP BY b.id, b.name, b.sku,  b.minimum_stock, b.created_at, c.name, u.name";

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.deficit-items', compact('rs','page'));
    }

    public function fast_moving_items(){
        $page = new Page();
        $page->name = "Fast Moving Items";
        
        $startOfYear = now()->startOfYear()->startOfDay()->toDateTimeString();
        $todayEnd = now()->endOfDay()->toDateTimeString();
        $today = now()->toDateString();
        $total_days = now()->diffInDays($startOfYear) + 1;

        // Base query
        $qry = "
            SELECT 
                b.id AS bid,
                b.name AS bname,
                b.sku,
                b.created_at,
                u.name AS unit,
                c.name AS cname,
                issued.total_issued,
                ROUND(issued.total_issued / $total_days, 2) AS daily_average
            FROM items b
            LEFT JOIN item_categories c ON c.id = b.category_id
            LEFT JOIN item_types u ON u.id = b.type_id
            LEFT JOIN (
                SELECT 
                    item_id,
                    SUM(quantity) AS total_issued
                FROM issuance_details
                WHERE issued_at BETWEEN '$startOfYear' AND '$todayEnd'
                GROUP BY item_id
            ) AS issued ON issued.item_id = b.id
            WHERE b.id > 0 AND issued.total_issued IS NOT NULL
        ";

        if (isset($_GET['search']) && strlen($_GET['search']) > 0) {
            $search = addslashes($_GET['search']);
            $qry .= " AND (b.sku LIKE '%$search%' OR b.name LIKE '%$search%')";
        }

        if (isset($_GET['category']) && strlen($_GET['category']) > 0) {
            $category = intval($_GET['category']);
            $qry .= " AND c.id = $category";
        }

        $qry .= "
            ORDER BY daily_average DESC
            LIMIT 100
        ";

        $rs = DB::select($qry);
    
       return view('theme.pages.custom.reports.fast-moving-items', compact('rs','page'));
    }

    public function log_export_activity(Request $request)
    {
        ActivityLog::create([
            'log_by' => auth()->id(),
            'activity_type' => 'export',
            'dashboard_activity' => 'exported a report',
            'activity_desc' => $request->description,
            'activity_date' => now(),
            'db_table' => 'reports',
            'old_value' => '',
            'new_value' => '',
            'reference' => null
        ]);

        return response()->json(['status' => 'success']);
    }
    
}
