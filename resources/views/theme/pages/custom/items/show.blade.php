@extends('theme.main')

@section('pagecss')
    <style>
        .barcode-label {
            display: inline-block;
            max-width: 250px;
            font-weight: bold;
            white-space: nowrap;
            overflow: hidden;
            text-align: center;
        }
    </style>
@endsection

@section('content')
<div class="wrapper p-5">

    <!-- Title (Left-Aligned) -->
    <div class="row mb-4">
        <div class="col-md-6">
            <h4 class="text-uppercase">{{ $page->name }}</h4>
        </div>
    </div>

    <!-- Centering the col-8 and col-2 with Compact Design -->
    <div class="row justify-content-center">

        <!-- Left Side: Item Details with QR Code and Back Button -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Item Details</div>

                <div class="card-body d-flex align-items-center gap-4">


                    <!-- Right Side: QR Code -->
                    @if($item->barcode != null)
                        <div class="text-center">
                            {!! \App\Models\Custom\Item::generateQrCode($item->barcode, 250) !!}
                            <br>
                            <span id="barcode-text" class="barcode-label">{{ $item->barcode }}</span>
                        </div>
                    @endif
                    
                    {{-- <div class="text-center">
                        {!! \App\Models\Custom\Item::generateQrCode($item->barcode, 250) !!}
                        <br> <strong class="fa fa-2x">{{ $item->barcode }}</strong>
                    </div> --}}

                    <!-- Left Side: Item Details Table -->
                    <div class="w-75">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <td width="30%"><strong>SKU</strong></td>
                                <td width="1%">:</td>
                                <td>{{ $item->sku }}</td>
                            </tr>
                            <tr>
                                <td><strong>Item Name</strong></td>
                                <td>:</td>
                                <td>{{ $item->name }}<br><small>{{ $item->subtitle }}</small></td>
                            </tr>
                            <tr>
                                <td><strong>Category</strong></td>
                                <td>:</td>
                                <td>{{ $item->category->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Unit</strong></td>
                                <td>:</td>
                                <td>{{ $item->unit->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Type</strong></td>
                                <td>:</td>
                                <td>{{ $item->type->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Inventory</strong></td>
                                <td>:</td>
                                <td>{{ $item->Inventory }}</td>
                            </tr>
                            <tr>
                                <td><strong>Minimum Stock</strong></td>
                                <td>:</td>
                                <td>{{ $item->minimum_stock }}</td>
                            </tr>
                        </table>
                    </div>

                </div>

                <!-- Divider Line -->
                <hr class="my-3">

                <!-- Back Button -->
                <div class="text-start pb-3 px-3">
                    <a href="javascript:window.history.back()" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>

        <!-- Right Side: Transactions (Compact & Closer) -->
        <div class="col-md-6">

            
            <div class="card">
                <div class="card-header">@if($item->type->name == "Equipment") Item Barcodes @else Stock Card @endif</div>

                <div class="card-body">

                    @if($item->type->name == "Equipment")
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Barcode</th>
                                        <th>Status</th>
                                        <th>Accountable</th>
                                        <th>Remarks</th>
                                        <th>Latest Transaction</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    {{-- @forelse($stock_card as $entry) --}}
                                    @forelse($par_details as $par_detail)
                                        <tr>
                                            <td>{{ $par_detail->barcode }}</td>
                                            <td>{{ $par_detail->status }}</td>
                                            <td>{{ $par_detail->par_header->employee->name }}</td>
                                            <td>{{ $par_detail->remarks ?? '-' }}</td>
                                            <td>{{ $par_detail->date_received }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-danger text-center">No transaction history</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    @else
                    
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th align="center">Transaction ID</th>
                                        <th align="right">Quantity</th>
                                        <th align="right">Running Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    {{-- @forelse($stock_card as $entry) --}}
                                    @forelse(collect($stock_card)->take(-10) as $entry)
                                        @php
                                            $trans_id = '';
                                            if($entry['type'] == 'Receiving'){
                                                $trans_id = '<a href="' . route('receiving.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no']  . '</a>';

                                            }
                                            if($entry['type'] == 'Issuance'){
                                                $trans_id = '<a href="' . route('issuance.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no']  . '</a>';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($entry['date'])->format('m/d/Y') }}</td>
                                            <td>{{ $entry['type'] }}</td>
                                            <td align="center">{!! $trans_id !!}</td>
                                            <td align="right">{{ $entry['quantity'] }}</td>
                                            <td align="right">{{ $entry['running_balance'] }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-danger text-center">No transaction history</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                    @endif

                </div>
            </div>

            
            {{-- <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body p-3" style="max-height: 500px; overflow-y: auto;">
                    <ul class="list-group list-group-flush">
                        @forelse($stock_card as $entry)
                            @php
                                $trans_id = '';
                                if ($entry['type'] == 'Receiving') {
                                    $trans_id = '<a href="' . route('receiving.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no'] . '</a>';
                                }
                                if ($entry['type'] == 'Issuance') {
                                    $trans_id = '<a href="' . route('issuance.transactions.show', ['id' => $entry['transaction_id']]) . '">' . $entry['ref_no'] . '</a>';
                                }
                            @endphp
                            <li class="list-group-item py-2">
                                <div class="d-flex justify-content-between align-items-center">
                                    <!-- Transaction ID and Type -->
                                    <div>
                                        {!! $trans_id !!}
                                    </div>
                                    <small class="text-uppercase fw-bold">{{ $entry['type'] }}</small>
                                </div>
                
                                <!-- Date and Quantity -->
                                <div class="d-flex justify-content-between align-items-center mt-1">
                                    <span class="text-muted">{{ \Carbon\Carbon::parse($entry['date'])->format('M d, Y') }}</span>
                                    <span class="badge bg-primary text-white" style="font-size: 14px;">{{ $entry['quantity'] }}</span>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item text-danger">No transactions</li>
                        @endforelse
                    </ul>
                </div>
                
                
            </div> --}}
        </div>

        
    </div>

    <div class="row mt-1">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Price History</div>
                <div class="card-body d-flex align-items-center gap-4">
                    <div class="">
                        <table class="table mb-0" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Ref #</th>
                                    <th>Date</th>
                                    <th>Supplier</th>
                                   
                                    <th>Price</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rts as $rt)
                                <tr>
                                    <td>{{$rt->header->ref_no}}</td>
                                    <td>{{$rt->header->date_received}}</td>
                                    <td>{!!\App\Models\Custom\ReceivingHeader::suppliers_name($rt->header->id)!!}</td>
                                    <td>{{number_format($rt->cost,2)}}</td>
                                </tr>
                                @empty
                                @endforelse
                            </tbody>
                            
                        </table>
                    </div>
                </div>              
            </div>
        </div>
    </div>

</div>
@endsection

@section('pagejs')
    <script>
        function fitTextToWidth(el, maxWidth) {
            let fontSize = 32; // Starting size
            const minFontSize = 10; // Don't go below this
            el.style.fontSize = fontSize + 'px';

            while (el.scrollWidth > maxWidth && fontSize > minFontSize) {
                fontSize--;
                el.style.fontSize = fontSize + 'px';
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const barcode = document.getElementById('barcode-text');
            fitTextToWidth(barcode, 250);
        });
    </script>
@endsection
