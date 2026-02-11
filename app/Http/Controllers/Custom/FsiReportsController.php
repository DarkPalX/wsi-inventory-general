<?php

namespace App\Http\Controllers\Custom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Facades\App\Helpers\{ListingHelper, FileHelper};

use App\Models\{Page};
use App\Models\Custom\{Item, ItemCategory, ItemAuthor, IssuanceHeader, IssuanceDetail, ParHeader, ParDetail, Receiver, ReceivingHeader, ReceivingDetail};
use App\Models\{User, ActivityLog};
use Auth;
use DB;


class FsiReportsController extends Controller

{
    private $paginate = 1000;
    private $searchFields = ['id'];

    public function stock_card(Request $request){

        $page = new Page();
        $page->name = "Stock Card";

        $items = Item::all();

        if($request->all() != []){

            $item = Item::find($request->id);

            $receiving_transactions = ReceivingHeader::where('receiving_headers.status', 'POSTED')
            ->join('receiving_details', 'receiving_details.receiving_header_id', '=', 'receiving_headers.id')
            ->where('receiving_details.item_id', $request->id)
            ->select('receiving_headers.posted_at', 'receiving_details.quantity', 'receiving_headers.id', 'receiving_headers.ref_no', DB::raw("'Receiving' as type"), 'receiving_headers.section_id')
            ->get();

            $issuance_transactions = IssuanceHeader::where('issuance_headers.status', 'POSTED')
            ->join('issuance_details', 'issuance_details.issuance_header_id', '=', 'issuance_headers.id')
            ->where('issuance_details.item_id', $request->id)
            ->select('issuance_headers.posted_at', 'issuance_details.quantity', 'issuance_headers.id', 'issuance_headers.ref_no', DB::raw("'Issuance' as type"), 'issuance_headers.section_id')
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
                    'section' => $transaction->section->name,
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

       return view('theme.pages.custom.reports-fsi.stock-card', compact('page', 'items', 'item', 'stock_card'));
    }

    public function inventory_custodian(Request $request){

        $page = new Page();
        $page->name = "Inventory Custodian Slip";

        $items = Item::all();

       return view('theme.pages.custom.reports-fsi.inventory-custodian', compact('page', 'items'));
    }

    public function inventory_physical_count(Request $request){

        $page = new Page();
        $page->name = "Reports on the Physical Count of Inventories";

        $items = Item::all();

       return view('theme.pages.custom.reports-fsi.inventory-physical-count', compact('page', 'items'));
    }

    public function property_card(Request $request){

        $page = new Page();
        $page->name = "Property Card";

        $items = Item::where('type_id', 2)->get();

        if($request->all() != []){

            $item = Item::find($request->id);
            
            $par_details = ParDetail::where('item_id', $item->id)->get();
        }
        else{
            $item = new Item();
            $item->id = null;
            $item->name = null;
            $item->MAC = null;

            $par_details = [];
        }

       return view('theme.pages.custom.reports-fsi.property-card', compact('page', 'items', 'item', 'par_details'));
    }

    public function property_acknowledgement_receipt(Request $request){

        $page = new Page();
        $page->name = "Property Acknowledgement Receipt";

        $id = $_GET['id'];
        $transfer_detail = ParDetail::find($id);

       return view('theme.pages.custom.reports-fsi.property-acknowledgement-receipt', compact('page', 'transfer_detail'));
    }

    public function property_plant_equipment_count(Request $request){

        $page = new Page();
        $page->name = "Report on the Physical Count of Property, Plant and Equipment";

        $items = Item::all();

       return view('theme.pages.custom.reports-fsi.property-plant-equipment-count', compact('page', 'items'));
    }

    public function unserviceable_property_inspection(Request $request){

        $page = new Page();
        $page->name = "Inventory and Inspection Report of Unserviceable Property";

        $items = Item::all();

       return view('theme.pages.custom.reports-fsi.unserviceable-property-inspection', compact('page', 'items'));
    }

    public function property_transfer(Request $request){

        $page = new Page();
        $page->name = "Property Transfer Report";

        $id = $_GET['id'];
        $transfer_detail = ParDetail::find($id);

       return view('theme.pages.custom.reports-fsi.property-transfer', compact('page', 'transfer_detail'));
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
