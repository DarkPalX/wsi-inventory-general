<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{User};
use App\Models\Custom\{RequisitionHeader, RequisitionDetail, Item};
use Carbon\Carbon;

class RequisitionTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $sections = [1, 2, 3];
        $entity_names = ['FSI', 'DPWH', 'DOH'];
        $fund_clusters = ['101', '102', '103'];
        $center_codes = ['RC001', 'RC002', 'RC003'];
        $statuses = ['POSTED', 'SAVED'];
        $user = User::find(2);

        for ($i = 1; $i <= 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            // $status = $i % 2 === 0 ? 'POSTED' : 'SAVED'; // Every 2nd one is 'POSTED'

            $header = RequisitionHeader::create([
                'ref_no' => null, // Set below after ID is known
                'entity_name' => $entity_names[array_rand($entity_names)],
                'fund_cluster' => $fund_clusters[array_rand($fund_clusters)],
                'section_id' => $user->section_id,
                // 'section_id' => $sections[array_rand($sections)],
                'responsibility_center_code' => $center_codes[array_rand($center_codes)],
                'date_requested' => Carbon::now()->subDays(rand(1, 10)),
                'date_needed' => Carbon::now()->addDays(rand(1, 5)),
                'purpose' => 'For office use',
                'remarks' => 'Requisition transaction ' . $i,
                'status' => $status,
                'requested_by' => $user->id,
                'requested_at' => Carbon::now()->subDays(rand(1, 10)),
                'approved_by' => $status === 'POSTED' ? 3 : null,
                'approved_at' => $status === 'POSTED' ? Carbon::now() : null,
                'posted_at' => $status === 'POSTED' ? Carbon::now() : null,
                'posted_by' => $status === 'POSTED' ? 2 : null,
                'cancelled_at' => null,
                'cancelled_by' => null,
                'created_by' => $user->id,
                'updated_by' => $user->id,
            ]);

            // Generate reference number after header creation
            $header->update([
                'ref_no' => RequisitionHeader::generateReferenceNo($header->id)
            ]);

            $detail_count = rand(2, 3);

            $valid_items = Item::all()->filter(fn($item) => $item->inventory > 0);

            if ($valid_items->isEmpty()) {
                continue;
            }

            for ($j = 1; $j <= $detail_count; $j++) {
                $item = $valid_items->random();

                RequisitionDetail::create([
                    'requisition_header_id' => $header->id,
                    'ref_no' => $header->ref_no,
                    'item_id' => $item->id,
                    'sku' => $item->sku,
                    'quantity' => rand(1, 10),
                ]);
            }

            
        }
    }
}
