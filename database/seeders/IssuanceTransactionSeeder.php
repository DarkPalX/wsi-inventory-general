<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Custom\{Item, RequisitionHeader, RequisitionDetail, IssuanceHeader, IssuanceDetail, ParHeader, ParDetail};
use Carbon\Carbon;
use Illuminate\Support\Arr;

class IssuanceTransactionSeeder extends Seeder
{
    public function run()
    {
        // Get only POSTED requisitions
        $posted_requisitions = RequisitionHeader::with('details')->where('status', 'POSTED')->inRandomOrder()->take(7)->get();

        foreach ($posted_requisitions as $index => $requisition) {
            
            $status = 'POSTED';
            
            // Create IssuanceHeader
            $header = IssuanceHeader::create([
                'ref_no' => null, // Temporary, to be updated after ID is generated
                'ris_no' => $requisition->ref_no,
                'section_id' => $requisition->section_id,
                'date_released' => now(),
                'attachments' => null,
                'remarks' => 'Issuance based on requisition ' . $requisition->ref_no,
                'status' => $status,
                'requested_at' => $requisition->requested_at,
                'requested_by' => $requisition->requested_by,
                'approved_at' => $requisition->approved_at,
                'approved_by' => $requisition->approved_by,
                'created_by' => 1,
                'updated_by' => 1,
                'posted_at' => $status === 'POSTED' ? now() : null,
                'posted_by' => $status === 'POSTED' ? 1 : null,
                'cancelled_at' => null,
                'cancelled_by' => null,
            ]);

            // Update reference number
            $header->update([
                'ref_no' => IssuanceHeader::generateReferenceNo($header->id),
            ]);

            $use_random_issue = rand(0, 1) === 1;

            // Loop through requisition details
            foreach ($requisition->details as $detail) {
                $item = $detail->item;
                if (!$item) continue;

                $available_qty = $item->inventory;
                if ($available_qty <= 0) continue;

                // $issued_qty = rand(1, $detail->quantity);
                // $issued_qty = min($available_qty, $detail->quantity);
                $issued_qty = $use_random_issue ? rand(1, $detail->quantity) : min($available_qty, $detail->quantity);

                // Cap issued quantity to available
                $issued_qty = min($issued_qty, $available_qty);

                $employee_id = rand(1,4);

                IssuanceDetail::create([
                    'issuance_header_id' => $header->id,
                    'item_id' => $item->id,
                    'sku' => $item->sku,
                    'item_type_id' => $item->type_id,
                    'quantity' => $issued_qty,
                    'cost' => $item->MAC,
                    'issued_by' => 4,
                    'issued_at' => now(),
                    'received_by' => $employee_id,
                    'received_at' => now()
                ]);
            }

            // FOR PAR
            $issuance_details = IssuanceDetail::where('issuance_header_id', $header->id)->get();

            foreach($issuance_details as $issuance_detail){

                if($issuance_detail->item_type_id == 2){
    
                    $existing_par_header = ParHeader::where('employee_id', $issuance_detail->received_by)->where('issuance_header_id', $issuance_detail->issuance_header_id)->first();
    
                    // PAR HEADER
                    if (!$existing_par_header) {
                        $parHeaderData = [
                            'employee_id' => $issuance_detail->received_by,
                            'section_id' => $header->section_id,
                            'issuance_header_id' => $issuance_detail->issuance_header_id,
                            'created_by' => $issuance_detail->created_by,
                        ];
                        $par_header = ParHeader::create($parHeaderData);
                    }

                    // PAR DETAIL
                    $parDetailData = [
                        'par_header_id' => $par_header->id ?? $existing_par_header->id,
                        'item_id' => $issuance_detail->item_id,
                        'sku' => $issuance_detail->sku,
                        'barcode' => 'FSI-' . strtoupper(uniqid(mt_rand(1000, 9999))),
                        'item_description' => $issuance_detail->item->name,
                        'price' => $issuance_detail->cost,
                        'quantity' => 1,
                        'date_received' => now()->format('Y/m/d'),
                    ];

                    ParDetail::create($parDetailData);
                }
                
            }

        }
    }
}
