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
                        $accountable = $par_detail->par_header->employee->name;
                    @endphp

                    <!-- Right Side: QR Code -->
                    @if($par_detail->barcode != null)
                        <div class="text-center">
                            <div class="hover-icon">
                       
                              <a href="#" onclick="printBarcode()"><i class="fa fa-print"></i></a>
                            </div>
                            <div id="barcode">{!! \App\Models\Custom\Item::generateQrCode(strtoupper($par_detail->barcode)."\nOwner: ".$accountable, 250) !!}</div>
                            
                            <br>
                            <span id="barcode-text" class="barcode-label">{{ strtoupper($par_detail->barcode) }}</span> 
                        </div>
                    @endif

                    <!-- Left Side: Item Details Table -->
                    <div class="w-75">
                   
                        <table class="table table-borderless mb-0">
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
                                <td><strong>Date Acquired</strong></td>
                                <td>:</td>
                                <td>{{ $par_detail->date_received }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>:</td>
                                <td>{{ $par_detail->status }}</td>
                            </tr>
                            <tr>
                                <td><strong>Reason/Remarks</strong></td>
                                <td>:</td>
                                <td>{{ $par_detail->remarks }}</td>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="bi-paperclip"></i> Property Acknowledgement Receipt</span>

                            <div class="card-tools d-flex align-items-center gap-2">
                                <a href="javascript:void(0)" class="text-decoration-none text-primary" onclick="document.getElementById('par_attachment').click();">
                                    <i class="bi-upload"></i> Upload
                                </a>

                                <a href="{{ env('APP_URL') .'/'. $par_detail->par_attachment }}" class="text-decoration-none text-primary" download>
                                    <i class="bi-download"></i> Download
                                </a>

                                <span style="margin: 7px;"> | </span>

                                <a href="javascript:void(0)" class="text-decoration-none text-danger" onclick="if(confirm('Are you sure you want to delete this?')) { document.getElementById('par_action').value = 'delete'; document.getElementById('par_form').submit(); }">
                                    <i class="bi-trash"></i> Delete
                                </a>
                                
                                <form id="par_form" method="post" action="{{ route('par.transactions.attachments.upload') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="par_detail_id" value="{{ $par_detail->id }}">
                                    <input type="file" id="par_attachment" name="par_attachment" style="display: none;" onchange="this.form.submit();" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" id="par_action" name="par_action" value="">
                                </form>

                            </div>
                        </div>

                        <div class="card-body d-flex align-items-center">

                            @if($par_detail->par_attachment)
                                <img width="100%" src="{{ env('APP_URL') .'/'. $par_detail->par_attachment }}">
                            @else
                                <div class="col-12 text-center"><span class="text-danger text-center p-2">No attachment available.</span></div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span><i class="bi-paperclip"></i> Property Transfer Report</span>

                            <div class="card-tools d-flex align-items-center gap-2">
                                <a href="javascript:void(0)" class="text-decoration-none text-primary" onclick="document.getElementById('ptr_attachment').click();">
                                    <i class="bi-upload"></i> Upload
                                </a>

                                <a href="{{ env('APP_URL') .'/'. $par_detail->ptr_attachment }}" class="text-decoration-none text-primary" download>
                                    <i class="bi-download"></i> Download
                                </a>

                                <span style="margin: 7px;"> | </span>

                                <a href="javascript:void(0)" class="text-decoration-none text-danger" onclick="if(confirm('Are you sure you want to delete this?')) { document.getElementById('ptr_action').value = 'delete'; document.getElementById('ptr_form').submit(); }">
                                    <i class="bi-trash"></i> Delete
                                </a>
                                
                                <form id="ptr_form" method="post" action="{{ route('par.transactions.attachments.upload') }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="par_detail_id" value="{{ $par_detail->id }}">
                                    <input type="file" id="ptr_attachment" name="ptr_attachment" style="display: none;" onchange="this.form.submit();" accept=".png, .jpg, .jpeg">
                                    <input type="hidden" id="ptr_action"  name="ptr_action" value="">
                                </form>
                            </div>

                        </div>

                        <div class="card-body d-flex align-items-center">

                            @if($par_detail->ptr_attachment)
                                <img width="100%" src="{{ env('APP_URL') .'/'. $par_detail->ptr_attachment }}">
                            @else
                                <div class="col-12 text-center"><span class="text-danger text-center p-2">No attachment available.</span></div>
                            @endif

                        </div>
                    </div>
                </div>
                
            </div>

        </div>

        
        <div class="text-start pb-3 px-3 mt-4 ">
            <a href="{{ route('par.transactions.index') }}" class="btn btn-secondary">Back</a>
            {{-- <a href="javascript:window.history.back()" class="btn btn-secondary">Back</a> --}}
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

    <script>
        function triggerFileInput() {
            document.getElementById('fileInput').click();
        }

        function handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                console.log('File selected:', file.name);
                // You can upload the file or preview it here
            }
        }

        function removeAttachment(){
            if(confirm('Are you sure you want to delete this?')) { 
                document.getElementById('par_form').submit(); 
            }
        }
    </script>

@endsection
