@extends('theme.main')

@section('pagecss')
@endsection

@section('content')
    <div class="wrapper p-5">
        
        {{-- <div class="row">

            <div class="col-md-6">
                <strong class="text-uppercase">{{ $page->name }}</strong>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item">{{ $page->name }}</li>
                        <li class="breadcrumb-item">Manage</li>
                    </ol>
                </nav>
                
            </div>
            
        </div> --}}

        <div class="row">

            <div class="col-6">
            
                <table>
                    <tr>
                        <td><a href="{{ route('issuance.employees.index') }}"><i class="fa-2x bi-arrow-left-square"></i>&nbsp;</a></td>
                        <td><strong class="fa-2x">{{ $employee->emp_id }}</strong></td>
                        <td><span class="fa-2x">:</span></td>
                        <td><span class="fa-2x">{{ $employee->name }}</span></td>
                        <td><small class="text-secondary">{{ $employee->department }} | {{ $employee->position }}</small></td>
                    </tr>
                </table>

            </div>
            
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <div class="btn-group">
                    <button id="action_dropdown_btn" type="button" class="btn btn-outline-dark dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" disabled>
                        Actions
                    </button>
                    <div id="action_dropdown" class="dropdown-menu">
                        <a class="dropdown-item" href="javascript:void(0)" data-action="transfer" onclick="multiple_restore()">Transfer</a>
                        <a class="dropdown-item" href="javascript:void(0)" data-action="close" onclick="multiple_delete()">Close</a>
                        <a class="dropdown-item text-danger disabled" href="javascript:void(0)" data-action="invalid" style="display: none;">Invalid selection</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">

            {{-- <form class="d-flex align-items-center" id="searchForm" style="margin-bottom:10px;font-size: 12px !important;">
                <input type="hidden" name="is_search" id="is_search" value="1">
                <table width="100%" style="margin-bottom: 0px;">
                    <tr style="font-size:12px;font-weight:bold;">
                        <td>Start Date</td>
                        <td>End Date</td>
                        <td>Receiver</td>
                        <td>Status</td>
                        <td colspan="3">Search</td>
                    </tr>
                    <tr>
                        <td><input type="date" class="form-control" name="start_date" id="start_date" style="font-size:12px;"  @if(isset($_GET['start_date'])) value="{{$_GET['start_date']}}" @endif></td>
                        <td><input type="date" class="form-control" name="end_date" id="end_date" style="font-size:12px;"  @if(isset($_GET['start_date'])) value="{{$_GET['end_date']}}" @endif></td>
                        <td>
                            <select name="receiver" id="receiver" class="form-control" style="font-size:12px;">
                                <option value="">- All -</option>
                                @php $receivers = \App\Models\Custom\Receiver::orderBy('name')->get(); @endphp
                                @forelse($receivers as $receiver)
                                    <option value="{{$receiver->id}}" @if(isset($_GET['receiver']) && $_GET['receiver']==$receiver->id) selected @endif>{{$receiver->name}}</option>
                                @empty

                                @endforelse
                            </select>
                        </td>
                        <td>
                            <select name="status" id="status" class="form-control" style="font-size:12px;">
                                <option value="" selected>- All -</option>
                                <option value="SAVED" @if(isset($_GET['status']) && $_GET['status']=='SAVED') selected @endif>SAVED</option>
                                <option value="POSTED" @if(isset($_GET['status']) && $_GET['status']=='POSTED') selected @endif>POSTED</option>
                                <option value="CANCELLED" @if(isset($_GET['status']) && $_GET['status']=='CANCELLED') selected @endif>CANCELLED</option>
                            </select>
                        </td>
                        <td width="30%"><input name="search" type="search" id="search" class="form-control" placeholder="Search by Ref#, SKU, Item, Remarks"  @if(isset($_GET['search'])) value="{{$_GET['search']}}" @endif style="font-size:12px;"></td>
                        <td>
                            <input type="submit" class="btn text-light" value="Search" style="font-size:12px; background-color: #3d80e3;">
                        </td>
                        @if(RolePermission::has_permission(3,auth()->user()->role_id,1))
                            <td align="right"><a href="{{ route('issuance.transactions.create') }}" class="btn text-white" style="font-size:14px; background-color: #0d6efd;">Create New Issuance</a></td>
                       @endif
                    </tr>
                    <tr><td><a href="{{route('issuance.transactions.index')}}" style="font-size:12px;">Reset Filter</a></td></tr>
                </table>
            </form> --}}

            <div class="table-responsive-faker" style="background-color: aliceblue;">
                <table id="authors_tbl" class="table table-hover" cellspacing="0" width="100%">
                    <thead class="table-secondary">
                        <tr>
                            <th width="2%">
                                <input type="checkbox" id="select-all">
                            </th>
                            <th>Issuance #</th>
                            <th>Item</th>
                            <th>Cost</th>
                            <th>Quantity</th>
                            <th>Received</th>
                            <th>Released</th>
                            <th>Remarks</th>
                            <th class="text-center" width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr id="row{{$transaction->id}}">
                                <td>
                                    <input type="checkbox" class="select-item" id="cb{{ $transaction->id }}">
                                    <label class="custom-control-label" for="cb{{ $transaction->id }}"></label>
                                </td>

                                <td><a href="{{ route('par.transactions.show', $transaction->item_id) }}?barcode={{ $transaction->barcode }}">{{ App\Models\Custom\IssuanceHeader::issuance_ref_no($transaction->issuance_header_id) }}</a></td>
                                <td>{{ $transaction->item_description }}</td>
                                <td>{{ $transaction->price }}</td>
                                <td>{{ $transaction->quantity }}</td>
                                <td>{{ $transaction->date_received }}</td>
                                <td>{{ $transaction->date_released_par }}</td>
                                <td>{{ $transaction->remarks }}</td>
                                <td class="flex justify-center text-center">
                                    <a href="javascript:void(0)" class="btn btn-light text-info" onclick="single_delete({{ $transaction->id }})" title="Transfer"><i class="fa-solid fa-user-tag"></i></a>
                                    <a href="javascript:void(0)" class="btn btn-light text-danger" onclick="single_delete({{ $transaction->id }})" title="Close"><i class="fa-solid fa-arrows-turn-right"></i></a>
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td class="text-center text-danger p-5" colspan="100%">No transaction available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="row">
                    <div class="col-md-12">
                        {{ $transactions->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>

        </div>

    </div>


    {{-- MODALS --}}
    @include('theme.layouts.modals')
    
    <form action="" id="posting_form" style="display:none;" method="post">
        @csrf
        <input type="text" id="employees" name="employees">
        <input type="text" id="status" name="status">
    </form>

@endsection

@section('pagejs')
	
    <!-- jQuery -->
    {{-- <script src="{{ asset('theme/js/jquery-3.6.0.min.js') }}"></script> --}}

    <script src="{{ asset('lib/ion-rangeslider/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        let listingUrl = "{{ route('issuance.employees.index') }}";
        let searchType = "{{ $searchType }}";
    </script>
    <script src="{{ asset('js/listing.js') }}"></script>

    <script>
        function single_delete(id){
            $('.single-delete').modal('show');
            $('.btn-delete').on('click', function() {
                post_form("{{ route('issuance.employees.single-delete') }}",'',id);
            });
        }

        function multiple_delete() {
            var counter = 0;
            var selected_employees = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_employees += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-delete').modal('show');
                $('.btn-delete-multiple').on('click', function() {
                    post_form("{{ route('issuance.employees.multiple-delete') }}", '', selected_employees);
                });
            }
        }
        
        function single_restore(id){
            post_form("{{ route('issuance.employees.single-restore') }}",'',id);
        }

        function multiple_restore() {
            var counter = 0;
            var selected_employees = '';

            $(".select-item:checked").each(function() {
                counter++;
                var fid = $(this).attr('id');
                
                if (fid !== undefined) {
                    selected_employees += fid.substring(2) + '|';
                }
            });

            if (counter < 1) {
                $('.prompt-no-selected').modal('show');
                return false;
            } else {
                $('.multiple-restore').modal('show');
                $('.btn-restore-multiple').on('click', function() {
                    post_form("{{ route('issuance.employees.multiple-restore') }}", '', selected_employees);
                });
            }
        }
        
        function post_form(url,status,employees){
            $('#posting_form').attr('action',url);
            $('#employees').val(employees);
            $('#status').val(status);
            $('#posting_form').submit();
        }
    </script>
    
    <script>
        document.querySelectorAll('.dropdown-menu').forEach(function (dropdown) {
            dropdown.addEventListener('click', function (e) {
                e.stopPropagation();
            });
        });
		
		function remove_file(remove_div, show_div){
			$(remove_div).hide();
			$(show_div).show();
		}
    </script>

    {{-- <script>
        jQuery(document).ready(function() {
            jQuery('#authors_tbl').dataTable();
        });
    </script> --}}
@endsection