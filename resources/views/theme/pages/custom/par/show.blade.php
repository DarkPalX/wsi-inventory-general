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
        .barcode {
          margin-top: 20px;
          width: 300px;
          height: 100px;
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Item Details</div>

                <div class="card-body d-flex align-items-center gap-4">
                    @php
                        $open_par = $par_history->where('status','OPEN')->first();
                        $accountable = 'FSI';
                        if($open_par){
                            if($open_par->par_header->employee){
                                $accountable = $open_par->par_header->employee->name.' ('.$open_par->par_header->employee->department.')';
                            }
                        }
                    @endphp

                    <!-- Right Side: QR Code -->
                    @if($barcode != null)
                        <div class="text-center">
                            <div class="hover-icon">
                       
                              <a href="#" onclick="printBarcode()"><i class="fa fa-print"></i></a>
                            </div>
                            <div id="barcode">{!! \App\Models\Custom\Item::generateQrCode(strtoupper($barcode)."\nOwner: ".$accountable, 250) !!}</div>
                            
                            <br>
                            <span id="barcode-text" class="barcode-label">{{ strtoupper($barcode) }}</span> 
                        </div>
                    @endif

                    <!-- Left Side: Item Details Table -->
                    <div class="w-75">
                   
                        <table class="table table-borderless mb-0">
                            {{-- <tr>
                                <td width="30%"><strong>Issuance Ref #</strong></td>
                                <td width="1%">:</td>
                                <td>{{ $item->sku }}</td>
                            </tr>
                            <tr>
                                <td width="30%"><strong>RIS #</strong></td>
                                <td width="1%">:</td>
                                <td>{{ $item->sku }}</td>
                            </tr> --}}
                            @if($accountable)
                            <tr>
                                <td width="30%"><strong>Accountable</strong></td>
                                <td width="1%">:</td>
                                <td>{{ $accountable }}</td>
                            </tr>
                            @else
                            <tr>
                                <td width="30%"><strong>Accountable</strong></td>
                                <td width="1%">:</td>
                                <td>FSI</td>
                            </tr>
                            @endif
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
                        </table>
                    </div>

                </div>

            </div>
        </div>

        <!-- Right Side: Transactions (Compact & Closer) -->
        <div class="col-md-12 mt-4">
            <div class="row justify-content-center">

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">Par History</div>

                        <div class="card-body d-flex align-items-center">

                            <table class="table table-hover">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Status</th>
                                        <th>Accountable</th>
                                        <th>Reason / Remarks</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($par_history as $history)
                                        <tr>
                                            <td>{{ $history->status }}</td>
                                            <td>{{ $history->par_header->employee->name }}</td>
                                            <td>{{ $history->remarks ?? '-' }}</td>
                                            <td>{{ $history->created_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <button type="button" class="btn text-secondary shadow-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="uil-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><a href="{{ route('reports-fsi.property-acknowledgement-receipt', ['id' => $history->id]) }}" target="_blank" class="dropdown-item" title="Generate Property Acknowledgement Receipt"><i class="uil-file"></i> Property Acknowledgement Receipt</a></li>
                                                        <li @if($history->status == 'OPEN') hidden @endif><a href="{{ route('reports-fsi.property-transfer', ['id' => $history->id]) }}" target="_blank" class="dropdown-item" title="Generate Transfer Report"><i class="uil-file"></i> Property Transfer Report</a></li>
                                                        <li><a href="{{ route('par.transactions.attachments', $history->id) }}" class="dropdown-item" title="View or Upload Attachments"><i class="uil-paperclip"></i> View or Upload Attachments</a></li>
                                                    </ul>
                                                </div>
                                                {{-- <a href="{{ route('reports-fsi.property-transfer', ['id' => $history->id]) }}" target="_blank" title="Generate Transfer Report" @if($history->status == 'OPEN') hidden @endif><i class="uil-file text-primary"></i></a> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center"><small>No transactions yet</small></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                </div>

                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header">Borrow History</div>

                        <div class="card-body d-flex align-items-center">

                            <table class="table table-hover">
                                <thead class="table-secondary">
                                    <tr>
                                        <th>Status</th>
                                        <th>Accountable</th>
                                        <th>Borrower</th>
                                        <th>Reason</th>
                                        <th>Date Borrowed</th>
                                        <th>Date Returned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($par_borrow_history as $borrow_history)
                                        <tr>
                                            <td>{{ $borrow_history->status }}</td>
                                            <td>{{ $borrow_history->par_detail->par_header->employee->name }}</td>
                                            <td>{{ $borrow_history->employee->name }}</td>
                                            <td>{{ $borrow_history->remarks ?? '-' }}</td>
                                            <td>{{ $borrow_history->date_borrowed }}</td>
                                            <td>{{ $borrow_history->date_returned }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%" class="text-center"><small>No transactions yet</small></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                    
                </div>
                
                
            </div>

        </div>

        
        <div class="text-start pb-3 px-3 mt-4 ">
            <a href="javascript:window.history.back()" class="btn btn-secondary">Back</a>
        </div>

    </div>

</div>
@endsection

@section('pagejs')
    <script>

         function printBarcode() {
              var printContents = document.getElementById("barcode").innerHTML;
              var originalContents = document.body.innerHTML;

              // Replace the body content with the barcode content
              document.body.innerHTML = printContents;

              // Call the print function
              window.print();

              // Restore the original body content
              document.body.innerHTML = originalContents;
            }
        
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
