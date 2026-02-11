<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Custom\{PurchaseOrderHeader, PurchaseOrderDetail, ReceivingHeader, ReceivingDetail, Item};
use Carbon\Carbon;

class ReceivingTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of possible supplier IDs
        $supplier_ids = [1, 2, 3]; // Example suppliers
        $statuses = ['POSTED', 'SAVED'];
        
        // Loop to create 20 headers
        for ($i = 1; $i <= 20; $i++) {
            $status = $statuses[array_rand($statuses)];
            // $status = $i % 2 === 0 ? 'POSTED' : 'SAVED'; // Every 2nd one is 'POSTED'
            
            // Randomly select po_number
            $po_header = PurchaseOrderHeader::where('status', 'POSTED')->inRandomOrder()->first();

            // Randomly select supplier IDs (1 or 2 suppliers)
            $random_suppliers = array_rand(array_flip($supplier_ids), rand(1, 2));
            $supplier_array = is_array($random_suppliers) ? $random_suppliers : [$random_suppliers];

            // Create a ReceivingHeader
            $header = ReceivingHeader::create([
                'supplier_id' => json_encode($supplier_array), // Store as JSON
                'section_id' => 1,
                'date_received' => Carbon::now(), // Current date and time
                'attachments' => null, // No attachments
                'remarks' => 'Receiving transaction ' . $i, // Remarks per transaction
                'status' => $status, // Status is 'SAVED' or 'POSTED'
                'created_at' => now(), // Created at
                'created_by' => 1, // Example user ID who created the entry
                'updated_by' => 1, // Example user ID who updated the entry
                'posted_at' => $status === 'POSTED' ? Carbon::now() : null, // Null if 'SAVED'
                'posted_by' => $status === 'POSTED' ? 1 : null, // Null if 'SAVED'
                'cancelled_at' => null, // No cancellation
                'cancelled_by' => null, // No cancellation
            ]);

            $header->update([
                'ref_no' => ReceivingHeader::generateReferenceNo($header->id)
            ]);

            // Seed 2-3 random details for each header
            $detail_count = rand(2, 3);
            for ($j = 1; $j <= $detail_count; $j++) {
                // Randomly pick a book_id between 1 and 10
                $item_id = rand(1, 20);

                $item = Item::find($item_id);

                // Insert ReceivingDetail data
                ReceivingDetail::create([
                    'receiving_header_id' => $header->id, // Link to the header
                    'item_id' => $item_id,
                    'sku' => $item->sku,
                    'cost' => rand(70, 150),
                    'order' => rand(20, 50), // Random quantity between 1 and 10
                    'quantity' => rand(50, 100)
                ]);
            }
        }
    }
}
