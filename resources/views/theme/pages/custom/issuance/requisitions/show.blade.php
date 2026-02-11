@extends('theme.main')

@section('pagecss')
<!-- Add any specific CSS for the show page here -->
@endsection

@section('content')
    <div class="wrapper p-5">
        
        <div class="row">
            <div class="col-md-6">
                <strong class="text-uppercase">Requisition Details</strong>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('issuance.requisitions.index') }}">Transactions</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Requisition Details</span>
                        <div class="card-tools">
                            <a href="javascript:void(0)" class="text-decoration-none" onclick="print_area('print-area')">
                                <i class="fa fa-print"></i> Print
                            </a>

                            @if(RolePermission::has_permission(4,auth()->user()->role_id,3) && ($requisition->status != 'CANCELLED' && $requisition->status != 'POSTED'))
                                <span style="margin: 7px;"> | </span>
                                <a href="javascript:void(0)" class="text-decoration-none" onclick="single_post({{ $requisition->id }})" title="Post Transaction">
                                    <i class="bi-send"></i> Post Transaction
                                </a>
                            @endif

                            @if(RolePermission::has_permission(4,auth()->user()->role_id,2) && ($requisition->status != 'CANCELLED' && $requisition->status != 'POSTED'))
                                <span style="margin: 7px;"> | </span>
                                <a href="javascript:void(0)" class="text-decoration-none" onclick="single_cancel({{ $requisition->id }})" title="Cancel Transaction">
                                    <i class="fa fa-cancel"></i> Cancel Transaction
                                </a>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="print-area">
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <p class="form-control-plaintext">
                                        <strong><small class="rounded text-white {{ $requisition->status == 'SAVED' ? 'bg-warning' : ($requisition->status == 'CANCELLED' ? 'bg-danger' : 'bg-success') }} p-1">{{ $requisition->status }}</small></strong>
                                        <small class="text-secondary" {{ $requisition->status == 'SAVED' ? 'hidden' : '' }}> | 
                                            @if($requisition->status == 'POSTED')
                                                {{ User::getName($requisition->posted_by) }} ({{ $requisition->posted_at }})
                                            @else
                                                {{ User::getName($requisition->cancelled_by) }} ({{ $requisition->cancelled_at }})
                                            @endif
                                        </small>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="col-sm-3 col-form-label">Reference #</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $requisition->ref_no }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date Requested</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $requisition->date_requested }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date Needed</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $requisition->date_needed }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Requested by</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ User::getSection($requisition->requested_by) }} | {{ User::getName($requisition->requested_by) }} <small class="text-secondary">({{ $requisition->requested_at }})</small></p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Purpose</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $requisition->purpose ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Remarks</label>
                                <div class="col-sm-9">
                                    <p class="form-control-plaintext">{{ $requisition->remarks ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="divider text-uppercase divider-center"><small>Item Details</small></div>

                            <div class="table-responsive-faker">
                                <table class="table table-hover" id="selected_items_table">
                                    <thead>
                                        <tr>
                                            <th width="15%">SKU</th>
                                            <th width="20%">Item</th>
                                            <th width="10%">Unit</th>
                                            <th width="15%">Type</th>
                                            <th width="10%">Qty</th>
                                            
                                            @if(App\Models\Custom\IssuanceHeader::hasIssuance($requisition->ref_no))
                                                <th width="10%">Qty Issued</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($requisition_details as $requisition_detail)
                                            <tr>
                                                <td>
                                                    {{ $requisition_detail->sku }}
                                                    <input name="sku[]" type="text" value="{{ $requisition_detail->sku }}" hidden>
                                                </td>
                                                <td>
                                                    {{ $requisition_detail->item()->withTrashed()->first()->name }}
                                                    <input name="sku[]" type="text" value="{{ $requisition_detail->item()->withTrashed()->first()->name }}" hidden>
                                                </td>
                                                <td>
                                                    {{ $requisition_detail->item->unit->name }}
                                                </td>
                                                <td>
                                                    {{ $requisition_detail->item->type->name }}
                                                </td>
                                                <td>
                                                    <input name="quantity[]" type="number" step="1" value="{{ $requisition_detail->quantity }}" min="1" class="border-0 bg-transparent" disabled>
                                                </td>

                                                @if(App\Models\Custom\IssuanceHeader::hasIssuance($requisition->ref_no))
                                                    <td>                                                        
                                                        <input name="quantity[]" type="number" step="1" value="{{App\Models\Custom\IssuanceDetail::getIssuedQty($requisition_detail->ref_no, $requisition_detail->item_id)  }}" min="1" class="border-0 bg-transparent" disabled>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="javascript:void(0);" onclick="if (window.history.length > 1) { window.history.back(); } else { window.location.href = '{{ route('issuance.requisitions.index') }}'; }" class="btn btn-secondary mt-4">Back</a>
                        <a @if(!App\Models\Custom\IssuanceHeader::hasIssuance($requisition->ref_no)) hidden @endif href="{{ route('issuance.requisitions.show-issuance',  $requisition->id) }}" class="btn btn-primary mt-4">View Issuance</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODALS --}}
    @include('theme.layouts.modals')
    
    <form action="" id="posting_form" style="display:none;" method="post">
        @csrf
        <input type="text" id="requisitions" name="requisitions">
        <input type="text" id="status" name="status">
    </form>
@endsection

@section('pagejs')
    <script>
        function print_area(area) {
            var printContents = document.querySelector('.' + area).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = '<div class="' + area + '">' + printContents + '</div>';

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload(); // Optionally reload the page to restore the original state
        }
        
        document.getElementById('select-all').addEventListener('change', function() {
            var checkboxes = document.querySelectorAll('.select-item');
            checkboxes.forEach(function(checkbox) {
                checkbox.checked = this.checked;
            }, this);
        });
        
        function single_restore(id){
            post_form("{{ route('issuance.requisitions.single-restore') }}",'',id);
        }

        function multiple_restore() {
            var counter = 0;
            var selected_items = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_items += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-restore').modal('show');
                $('.btn-restore-multiple').on('click', function() {
                    post_form("{{ route('issuance.requisitions.multiple-restore') }}", '', selected_items);
                });
            }
        }
        
        function single_post(id){
            $('.single-post').modal('show');
            $('.btn-post').on('click', function() {
                post_form("{{ route('issuance.requisitions.single-post') }}",'',id);
            });
        }

        function single_cancel(id){
            $('.single-cancel').modal('show');
            $('.btn-delete').on('click', function() {
                post_form("{{ route('issuance.requisitions.single-delete') }}",'',id);
            });
        }

        function multiple_cancel() {
            var counter = 0;
            var selected_items = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_items += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-cancel').modal('show');
                $('.btn-delete-multiple').on('click', function() {
                    post_form("{{ route('issuance.requisitions.multiple-delete') }}", '', selected_items);
                });
            }
        }
        
        function post_form(url,status,requisitions){
            $('#posting_form').attr('action',url);
            $('#requisitions').val(requisitions);
            $('#status').val(status);
            $('#posting_form').submit();
        }
        
        function create_issuance_post_form(id){
            $('#requisition_id').val(id);
            $('#create_issuance_post_form').submit();
        }
        
        function edit_issuance_post_form(id){
            $('#requisition_id_update').val(id);
            $('#edit_issuance_post_form').submit();
        }

    </script>
@endsection
